# cisco_ansible_gui_login.py
import os, sqlite3, binascii, hashlib
import tkinter as tk
from tkinter import messagebox, scrolledtext, Toplevel
from PIL import Image, ImageTk
import subprocess
import sqlite3
import hashlib
import os
import hmac
import datetime
# ========= CONFIG GÉNÉRALE =========
INVENTORY = "inventory.ini"      # ton inventaire Ansible existant
DB_FILE   = "users.db"           # base SQLite pour l'authentification
PBKDF2_ITER = 200_000            # coût de hachage

# ========= BASE DE DONNÉES / AUTH =========
def db_connect():
    return sqlite3.connect(DB_FILE)

def init_db():
    """Crée la table users si elle n'existe pas."""
    con = db_connect()
    cur = con.cursor()
    cur.execute("""
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password_hash TEXT NOT NULL,
            salt TEXT NOT NULL,
            role TEXT NOT NULL DEFAULT 'admin',
            email TEXT UNIQUE
        )
    """)
    cur.execute("""
        CREATE TABLE IF NOT EXISTS command_history (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT,
            router_name TEXT,
            command TEXT,
            exec_time TEXT
        )
    """)
    con.commit()
    con.close()
    
    

def db_is_empty():
    con = db_connect()
    cur = con.cursor()
    cur.execute("SELECT COUNT(*) FROM users")
    n = cur.fetchone()[0]
    con.close()
    return n == 0
    
    



def hash_password(password: str, salt_hex: str | None = None):
    if not salt_hex:
        salt = os.urandom(16)
        salt_hex = binascii.hexlify(salt).decode()
    else:
        salt = binascii.unhexlify(salt_hex.encode())
    pwd_hash = hashlib.pbkdf2_hmac("sha256", password.encode(), salt, PBKDF2_ITER)
    return salt_hex, binascii.hexlify(pwd_hash).decode()

def create_user(username: str, password: str, role: str = "admin", email: str = ""):
    con = db_connect()
    cur = con.cursor()
    salt_hex, hash_hex = hash_password(password)
    try:
        cur.execute(
            "INSERT INTO users (username, password_hash, salt, role, email) VALUES (?,?,?,?,?)",
            (username, hash_hex, salt_hex, role, email)
        )
        con.commit()
        ok = True
        msg = "Utilisateur créé."
    except sqlite3.IntegrityError:
        ok = False
        msg = "Nom d'utilisateur déjà pris."
    finally:
        con.close()
    return ok, msg


def verify_password(password: str, stored_hash_hex: str, salt_hex: str):
    salt = binascii.unhexlify(salt_hex.encode())
    pwd_hash = hashlib.pbkdf2_hmac("sha256", password.encode(), salt, PBKDF2_ITER)
    return hmac.compare_digest(binascii.hexlify(pwd_hash).decode(), stored_hash_hex)

    return ok, msg

def get_user(username: str):
    con = db_connect()
    cur = con.cursor()
    cur.execute("SELECT id, username, password_hash, salt, role FROM users WHERE username = ?", (username,))
    row = cur.fetchone()
    con.close()
    return row



def log_command(username: str, router_name: str, command: str):
    """Enregistre la commande exécutée dans la table command_history."""
    con = db_connect()
    cur = con.cursor()
    cur.execute(
        "INSERT INTO command_history (username, router_name, command, exec_time) VALUES (?,?,?,?)",
        (username, router_name, command, datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"))
    )
    con.commit()
    con.close()



# ========= FENÊTRE DE LOGIN =========
class LoginWindow(tk.Tk):
    def __init__(self):
        super().__init__()
        self.title("Authentification - Cisco Ansible GUI")
        self.geometry("400x320")
        self.configure(bg="#2c3e50")
        self.resizable(False, False)
        
        
        # Logo (optionnel)
        top = tk.Frame(self, bg="#2c3e50")
        top.pack(pady=10)
        try:
            logo_img = Image.open("logo.png").resize((240, 48))
            self.logo_tk = ImageTk.PhotoImage(logo_img)
            tk.Label(top, image=self.logo_tk, bg="#2c3e50").pack()
        except:
            tk.Label(top, text="Cisco Ansible GUI", font=("Arial", 18, "bold"), bg="#2c3e50", fg="white").pack()

        frm = tk.LabelFrame(self, text="🔐 Connexion", padx=12, pady=12,
                            bg="#34495e", fg="white", font=("Arial", 11, "bold"))
        frm.pack(fill="x", padx=16, pady=12)

        tk.Label(frm, text="Username", bg="#34495e", fg="white").grid(row=0, column=0, sticky="w")
        self.ent_user = tk.Entry(frm, width=24)
        self.ent_user.grid(row=0, column=1, padx=6, pady=6)

        tk.Label(frm, text="Password", bg="#34495e", fg="white").grid(row=1, column=0, sticky="w")
        self.ent_pass = tk.Entry(frm, show="*", width=24)
        self.ent_pass.grid(row=1, column=1, padx=6, pady=6)

        btns = tk.Frame(frm, bg="#34495e")
        btns.grid(row=2, column=0, columnspan=2, pady=8)
        tk.Button(btns, text="Se connecter", command=self.do_login,
                  bg="#27ae60", fg="white", font=("Arial", 10, "bold"), width=16).pack(side="left", padx=5)
        tk.Button(btns, text="Créer user DB", command=self.open_create_user_window,
                  bg="#2980b9", fg="white", font=("Arial", 10, "bold"), width=16).pack(side="left", padx=5)

        self.lbl_info = tk.Label(self, text="Entrez vos identifiants pour accéder à la GUI.", bg="#2c3e50", fg="white")
        self.lbl_info.pack(pady=6)

        self.bind("<Return>", lambda e: self.do_login())
        tk.Button(frm, text="Mot de passe oublié ?", command=self.forgot_password,
          bg="#f39c12", fg="white", font=("Arial", 9, "bold")).grid(row=3, column=0, columnspan=2, pady=5)
          
    def forgot_password(self):
        top = tk.Toplevel(self)
        top.title("Mot de passe oublié")
        top.geometry("350x200")
        top.configure(bg="#2c3e50")

        tk.Label(top, text="Username:", bg="#2c3e50", fg="white").pack(pady=5)
        e_user = tk.Entry(top, width=25)
        e_user.pack()
     
        tk.Label(top, text="Email associé au compte:", bg="#2c3e50", fg="white").pack(pady=5)
        e_email = tk.Entry(top, width=25)
        e_email.pack()

        tk.Label(top, text="Nouveau mot de passe:", bg="#2c3e50", fg="white").pack(pady=5)
        e_new_pwd = tk.Entry(top, show="*", width=25)
        e_new_pwd.pack()

        def do_reset():
            username = e_user.get().strip()
            email = e_email.get().strip()
            new_pwd = e_new_pwd.get().strip()

            if not username or not email or not new_pwd:
                messagebox.showwarning("Attention", "Tous les champs sont requis")
                return

            con = db_connect()
            cur = con.cursor()
            cur.execute("SELECT id, email FROM users WHERE username = ?", (username,))
            row = cur.fetchone()
            if not row:
                messagebox.showerror("Erreur", "Utilisateur inconnu")
                con.close()
                return
            _id, stored_email = row
            if stored_email.lower() != email.lower():
                messagebox.showerror("Erreur", "Email ne correspond pas à l'utilisateur")
                con.close()
                return

            salt_hex, hash_hex = hash_password(new_pwd)
            cur.execute("UPDATE users SET password_hash=?, salt=? WHERE id=?", (hash_hex, salt_hex, _id))
            con.commit()
            con.close()
            messagebox.showinfo("OK", "Mot de passe réinitialisé avec succès !")
            top.destroy()

        tk.Button(top, text="Réinitialiser", command=do_reset, bg="#27ae60", fg="white",
                  font=("Arial", 10, "bold")).pack(pady=10)



    # -----------------------
    # Login
    # -----------------------
    def do_login(self):
        username = self.ent_user.get().strip()
        password = self.ent_pass.get().strip()
        if not username or not password:
            messagebox.showwarning("Attention", "Remplissez username et password")
            return
        row = get_user(username)
        if not row:
            messagebox.showerror("Erreur", "Utilisateur inconnu.")
            return
        _id, _u, pwd_hash, salt, role = row
        if verify_password(password, pwd_hash, salt):
            self.destroy()
            launch_main_gui(username, role)
            
        else:
            messagebox.showerror("Erreur", "Mot de passe incorrect.")

    # -----------------------
    # Fenêtre de création utilisateur
    # -----------------------
   
   
    def open_create_user_window(self):
        top = tk.Toplevel(self)
        top.title("Créer un nouvel utilisateur")
        top.geometry("500x450")
        top.configure(bg="#1f2c3d")
        top.resizable(False, False)

    
        tk.Label(top, text="Créer un nouvel utilisateur", font=("Segoe UI", 16, "bold"),
                 bg="#1f2c3d", fg="#f5f5f5").pack(pady=15)

    
        frame_inputs = tk.Frame(top, bg="#2a3b4d", padx=20, pady=20)
        frame_inputs.pack(fill="x", padx=20, pady=10)

        tk.Label(frame_inputs, text="Username", bg="#2a3b4d", fg="#f5f5f5", font=("Segoe UI", 11)).pack(anchor="w", pady=5)
        e_user = tk.Entry(frame_inputs, width=30, font=("Segoe UI", 11))
        e_user.pack(pady=3)

        tk.Label(frame_inputs, text="Password", bg="#2a3b4d", fg="#f5f5f5", font=("Segoe UI", 11)).pack(anchor="w", pady=5)
        e_pwd = tk.Entry(frame_inputs, show="*", width=30, font=("Segoe UI", 11))
        e_pwd.pack(pady=3)

        tk.Label(frame_inputs, text="Email", bg="#2a3b4d", fg="#f5f5f5", font=("Segoe UI", 11)).pack(anchor="w", pady=5)
        e_email = tk.Entry(frame_inputs, width=30, font=("Segoe UI", 11))
        e_email.pack(pady=3)

        tk.Label(frame_inputs, text="Role", bg="#2a3b4d", fg="#f5f5f5", font=("Segoe UI", 11)).pack(anchor="w", pady=5)
        role_var = tk.StringVar(value="user")
        role_menu = tk.OptionMenu(frame_inputs, role_var, "user", "admin")
        role_menu.config(width=28, font=("Segoe UI", 11), bg="#34495e", fg="white", relief="flat")
        role_menu.pack(pady=3)

    
        def do_create():
            username = e_user.get().strip()
            password = e_pwd.get().strip()
            role = role_var.get()
            email = e_email.get().strip()

            if not username or not password:
                messagebox.showwarning("Attention", "Remplissez username et password")
                return
            ok, msg = create_user(username, password, role=role, email=email)
            if ok:
                messagebox.showinfo("OK", msg)
                top.destroy()
            else:
                messagebox.showerror("Erreur", msg)

        tk.Button(top, text="Créer", command=do_create, bg="#27ae60", fg="white",
                  font=("Segoe UI", 12, "bold"), width=25, relief="flat").pack(pady=20)






#--------------------------------------------------------

# Variables globales GUI principale
output_text = None
entries = {}
hub_var = None

def run_ansible_command(commands, username="unknown"):
    """Exécute des commandes IOS via Ansible et les logue."""
    if isinstance(commands, list):
        cmd_str = "\n".join(commands)
    else:
        cmd_str = commands

    # Enregistrer la commande pour chaque routeur (ici tous les routeurs)
    for router in ["R1", "R2", "R3"]:  # Remplace par ton inventaire réel
        log_command(username, router, cmd_str)

    result = subprocess.run(
        [
            "ansible", "all", "-i", INVENTORY, "-m", "cisco.ios.ios_config",
            "-a", f"lines='{cmd_str}'",
            "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
        ],
        stdout=subprocess.PIPE,
        stderr=subprocess.PIPE,
        text=True
    )

    output_text.delete(1.0, tk.END)
    output_text.insert(tk.END, (result.stdout or "") + "\n" + (result.stderr or ""))


# --- Fonctions des boutons ---
def show_ssh_status():
    try:
        result = subprocess.run(
            [
                "ansible", "all", "-i", INVENTORY, "-m", "cisco.ios.ios_command",
                "-a", "commands='show running-config | include ip ssh'",
                "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
            ],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE,
            text=True
        )

        output_text.delete(1.0, tk.END)

        hosts_blocks = result.stdout.split("SUCCESS => {")
        for block in hosts_blocks[1:]:
            lines = block.split("\\n")
            host_line = lines[0].strip()
            host = host_line.split()[0]
            status = "SSH DISABLED"
            for line in lines:
                line = line.strip().replace('"', '')
                if "ip ssh version 2" in line:
                    status = "SSH ENABLED"
            output_text.insert(tk.END, f"{host}: {status}\n")

    except Exception as e:
        messagebox.showerror("Erreur", str(e))

def show_users():
    try:
        result = subprocess.run(
            [
                "ansible", "all", "-i", INVENTORY, "-m", "cisco.ios.ios_command",
                "-a", "commands='show running-config | include username'",
                "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
            ],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE,
            text=True
        )
        output_text.delete(1.0, tk.END)

        hosts_blocks = result.stdout.split("SUCCESS => {")
        for block in hosts_blocks[1:]:
            lines = block.split("\\n")
            host_line = lines[0].strip()
            host = host_line.split()[0]
            output_text.insert(tk.END, f"====================\n{host}\n====================\n")
            for line in lines:
                line = line.strip().replace('"', '')
                if line.startswith("username "):
                    username = line.split()[1]
                    output_text.insert(tk.END, f"- {username}\n")
            output_text.insert(tk.END, "\n")
    except Exception as e:
        messagebox.showerror("Erreur", str(e))

def add_user():
    username = username_entry.get().strip()
    password = password_entry.get().strip()
    if username and password:
        run_ansible_command(f"username {username} privilege 15 secret {password}")
        output_text.delete(1.0, tk.END)
        output_text.insert(tk.END, f"{username} added successfully!\n")
    else:
        messagebox.showwarning("Attention", "Entrez username et password")

def enable_ssh():
    commands = [
        "ip domain-name koussay.com",
        "crypto key generate rsa modulus 1024",
        "ip ssh version 2"
    ]
    run_ansible_command(commands)
    output_text.delete(1.0, tk.END)
    output_text.insert(tk.END, "SSH ENABLED\n")

def disable_ssh():
    commands = ["no ip ssh version 2"]
    run_ansible_command(commands)
    try:
        subprocess.run(
            [
                "ansible", "all", "-i", INVENTORY, "-m", "cisco.ios.ios_config",
                "-a", "lines='crypto key zeroize rsa'",
                "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
            ],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE,
            text=True,
            timeout=5
        )
    except subprocess.TimeoutExpired:
        output_text.insert(tk.END, "\nCommande 'crypto key zeroize rsa' exécutée (timeout ignoré)")
    output_text.delete(1.0, tk.END)
    output_text.insert(tk.END, "SSH DISABLED\n")

# --- OSPF ---
def configure_ospf():
    process_id = ospf_process_entry.get().strip()
    network = ospf_network_entry.get().strip()
    mask = ospf_mask_entry.get().strip()
    area = ospf_area_entry.get().strip()

    if process_id and network and mask and area:
        commands = [
            f"router ospf {process_id}",
            f"network {network} {mask} area {area}"
        ]
        run_ansible_command(commands)
        output_text.delete(1.0, tk.END)
        output_text.insert(
            tk.END,
            f"OSPF {process_id} configuré sur réseau {network} {mask} (area {area})\n"
        )
    else:
        messagebox.showwarning("Attention", "Remplissez tous les champs OSPF")


def show_ospf():
    try:
        result = subprocess.run(
            [
                "ansible", "all", "-i", INVENTORY, "-m", "cisco.ios.ios_command",
                "-a", "commands='show ip ospf'",
                "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
            ],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE,
            text=True
        )
        output_text.delete(1.0, tk.END)
        lines = result.stdout.splitlines()
        current_host = ""
        for line in lines:
            line = line.strip().replace('"','').replace('\\','')
            if line.endswith("=> {") and "|" in line:
                current_host = line.split("|")[0].strip()
            elif "Routing Process" in line:
                parts = line.split("with ID")
                if len(parts) == 2:
                    ospf_process = parts[0].replace("Routing Process", "").strip()
                    router_id = parts[1].split()[0].strip()
                    output_text.insert(tk.END, f"{current_host}: OSPF {ospf_process}, Router ID {router_id}\n")
    except Exception as e:
        messagebox.showerror("Erreur", str(e))

def configure_eigrp():
    as_number = eigrp_as_entry.get().strip()
    network = eigrp_network_entry.get().strip()
    if not as_number:
        messagebox.showwarning("Attention", "Remplissez le champ AS EIGRP")
        return
    commands = [f"router eigrp {as_number}"]
    if network:
        commands.append(f"network {network}")
    else:
        commands.append("network 0.0.0.0 0.0.0.0")
    lines_str = "\n".join(commands)
    subprocess.run([
        "ansible", "all", "-i", INVENTORY,
        "-m", "cisco.ios.ios_config",
        "-a", f"lines='{lines_str}'",
        "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
    ], capture_output=True, text=True)
    output_text.delete(1.0, tk.END)
    output_text.insert(tk.END, f"EIGRP {as_number} configuré sur réseau {network if network else '0.0.0.0/0'}\n")

def show_eigrp():
    result = subprocess.run([
        "ansible", "all", "-i", INVENTORY,
        "-m", "cisco.ios.ios_command",
        "-a", "commands='show running-config'",
        "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
    ], capture_output=True, text=True)

    output_text.delete(1.0, tk.END)
    lines = result.stdout.splitlines()
    host = ""
    capture = False
    for line in lines:
        line = line.strip()
        if line.endswith("| SUCCESS =>"):
            host = line.split()[0]
            capture = False
        elif line.startswith("router eigrp"):
            capture = True
            output_text.insert(tk.END, f"{host}: {line}\n")
        elif capture:
            if line.startswith("router ") or line.startswith("!"):
                capture = False
            else:
                output_text.insert(tk.END, f"  {line}\n")
    output_text.insert(tk.END, "\nEIGRP Configuration affichée\n")

def disable_eigrp():
    as_number = eigrp_as_entry.get().strip()
    if as_number:
        commands = f"no router eigrp {as_number}"
        subprocess.run([
            "ansible", "all", "-i", INVENTORY,
            "-m", "cisco.ios.ios_config",
            "-a", f"lines='{commands}'",
            "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
        ], capture_output=True, text=True)
        output_text.delete(1.0, tk.END)
        output_text.insert(tk.END, f"EIGRP AS {as_number} désactivé sur tous les routeurs\n")
    else:
        messagebox.showwarning("Attention", "Remplissez le champ AS EIGRP")

# --- DMVPN ---
def configure_dmVPN():
    tunnel_id = entries["Tunnel ID"].get().strip()
    if not tunnel_id:
        messagebox.showwarning("Attention", "Remplissez le Tunnel ID")
        return

    commands = [
        f"interface Tunnel{tunnel_id}",
        f" description {entries['Description'].get()}",
        f" bandwidth {entries['Bandwidth'].get()}",
        f" ip address {entries['Tunnel IP'].get()} {entries['Mask'].get()}",
        " no ip redirects",
        f" ip mtu {entries['MTU'].get()}",
        f" ip nhrp authentication {entries['NHRP Auth'].get()}",
    ]
    for map_entry in entries["NHRP Maps (comma)"].get().split(","):
        map_entry = map_entry.strip()
        if map_entry:
            commands.append(f" ip nhrp map {map_entry}")

    commands.append(f" ip nhrp network-id {tunnel_id}")
    commands.append(f" ip nhrp holdtime {entries['NHRP Holdtime'].get()}")

    for nhs_entry in entries["NHS (comma)"].get().split(","):
        nhs_entry = nhs_entry.strip()
        if nhs_entry:
            nhs_ip = nhs_entry.split()[0]
            commands.append(f" ip nhrp nhs {nhs_ip}")

    if entries['QoS'].get().strip():
        commands.append(f" qos {entries['QoS'].get().strip()}")   # ex: pre-classify
    if entries['Keepalive'].get().strip():
        commands.append(f" keepalive {entries['Keepalive'].get().strip()}")  # ex: 10 3
    if entries['TCP MSS'].get().strip():
        commands.append(f" ip tcp adjust-mss {entries['TCP MSS'].get().strip()}")

    commands.append(f" tunnel source {entries['Tunnel Source'].get().strip()}")
    commands.append(" tunnel mode gre multipoint")
    commands.append(f" tunnel protection ipsec profile {entries['IPSec Profile'].get().strip()}")

    if hub_var.get() == "hub":
        commands.append(" ip nhrp map multicast dynamic")

    cmd_str = "\n".join(commands)
    result = subprocess.run([
        "ansible", "all", "-i", INVENTORY,
        "-m", "cisco.ios.ios_config",
        "-a", f"lines='{cmd_str}'",
        "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
    ], capture_output=True, text=True)

    output_text.delete(1.0, tk.END)
    output_text.insert(tk.END, f"DMVPN configuré sur Tunnel{tunnel_id}.\n")
    output_text.insert(tk.END, (result.stdout or "") + "\n" + (result.stderr or ""))

def disable_dmVPN():
    tunnel_id = entries["Tunnel ID"].get().strip()
    if not tunnel_id:
        messagebox.showwarning("Attention", "Remplissez le Tunnel ID")
        return

    check_cmd = f"show run | section Tunnel{tunnel_id}"
    result_check = subprocess.run([
        "ansible", "all", "-i", INVENTORY,
        "-m", "cisco.ios.ios_command",
        "-a", f"commands='{check_cmd}'",
        "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
    ], capture_output=True, text=True)

    output_text.delete(1.0, tk.END)

    if "interface Tunnel" not in (result_check.stdout or ""):
        output_text.insert(tk.END, f"Tunnel{tunnel_id} introuvable sur les routeurs.\n")
        output_text.insert(tk.END, (result_check.stdout or "") + "\n")
        return

    shutdown_cmds = f"interface Tunnel{tunnel_id}\n shutdown"
    result_shutdown = subprocess.run([
        "ansible", "all", "-i", INVENTORY,
        "-m", "cisco.ios.ios_config",
        "-a", f"lines='{shutdown_cmds}'",
        "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
    ], capture_output=True, text=True)

    if result_shutdown.returncode == 0 and "Invalid input" not in (result_shutdown.stderr or ""):
        output_text.insert(tk.END, f"Tunnel{tunnel_id} désactivé avec succès.\n")
        output_text.insert(tk.END, (result_shutdown.stdout or "") + "\n")
    else:
        output_text.insert(tk.END, f"Erreur lors de la désactivation de Tunnel{tunnel_id} :\n")
        output_text.insert(tk.END, (result_shutdown.stderr or "") + "\n")

def show_dmVPN():
    tunnel_id = entries["Tunnel ID"].get().strip()
    if not tunnel_id:
        messagebox.showwarning("Attention", "Remplissez le Tunnel ID")
        return

    result = subprocess.run([
        "ansible", "all", "-i", INVENTORY,
        "-m", "cisco.ios.ios_command",
        "-a", "commands='show dmvpn'",
        "--ssh-common-args=-o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null"
    ], capture_output=True, text=True)

    output_text.delete(1.0, tk.END)
    output_text.insert(tk.END, f"Status Tunnel{tunnel_id} :\n\n")
    if result.returncode != 0:
        output_text.insert(tk.END, f"Erreur Ansible :\n{result.stderr}")
    else:
        output_text.insert(tk.END, result.stdout)

# ========= CONSTRUCTION DE LA GUI PRINCIPALE =========
def launch_main_gui(username: str, role: str):
    global output_text, entries, hub_var
    root = tk.Tk()
    root.title(f"Cisco Ansible GUI  —  Connecté: {username}")
    root.geometry("750x600")
    root.configure(bg="#2c3e50")

    top_frame = tk.Frame(root, bg="#2c3e50")
    top_frame.pack(fill="x", pady=10, padx=10)
    
    def logout():
        root.destroy()  
        app = LoginWindow()
        app.mainloop()

    tk.Button(top_frame, text="Logout", command=logout,
              bg="#3498db", fg="white", font=("Arial", 9, "bold")).pack(side="right", padx=5, pady=5)

    # ==== Boutons réservés aux admins ====
    if role == "admin":

        # ---- Bouton Créer un utilisateur ----
        tk.Button(top_frame, text="Create User", 
                  command=lambda: open_create_user_window(),
                  bg="#27ae60", fg="white", font=("Arial", 9, "bold")
                  ).pack(side="right", padx=5, pady=5)

        # ---- Bouton Supprimer un utilisateur ----
        def delete_user():
            def do_delete():
                username_to_delete = entry_user.get().strip()
                if not username_to_delete:
                    messagebox.showwarning("Attention", "Entrez un nom d'utilisateur")
                    return
                con = db_connect()
                cur = con.cursor()
                cur.execute("DELETE FROM users WHERE username = ?", (username_to_delete,))
                if cur.rowcount == 0:
                    messagebox.showinfo("Info", f"Utilisateur '{username_to_delete}' non trouvé.")
                else:
                    messagebox.showinfo("OK", f"Utilisateur '{username_to_delete}' supprimé.")
                con.commit()
                con.close()
                top.destroy()
                show_db_users()  

            top = tk.Toplevel(root)
            top.title("Supprimer un utilisateur")
            top.geometry("300x120")
            top.configure(bg="#2c3e50")
            tk.Label(top, text="Username à supprimer", bg="#2c3e50", fg="white").pack(pady=5)
            entry_user = tk.Entry(top, width=25)
            entry_user.pack(pady=5)
            tk.Button(top, text="Supprimer", command=do_delete, 
                      bg="#c0392b", fg="white", font=("Arial", 10, "bold")).pack(pady=5)

        tk.Button(top_frame, text="Delete User", command=delete_user,
                  bg="#c0392b", fg="white", font=("Arial", 9, "bold")).pack(side="right", padx=5, pady=5)

        # ---- Bouton afficher DB ----
        def show_db_users():
            con = db_connect()
            cur = con.cursor()
            cur.execute("SELECT username, password_hash, salt, role FROM users")
            rows = cur.fetchall()
            con.close()

            output_text.delete(1.0, tk.END)
            for u, pwd_hash, salt, r in rows:
                output_text.insert(tk.END, f"Username: {u}\nPassword Hash: {pwd_hash}\nSalt: {salt}\nRole: {r}\n\n")

        tk.Button(top_frame, text="Show DB Users", command=show_db_users,
                  bg="#e74c3c", fg="white", font=("Arial", 9, "bold")).pack(side="right", padx=5, pady=5)


  



    # --- Cadre Ajout User (ROUTEURS) ---
    
    frame_user = tk.LabelFrame(root, text="➕ Add User (Routeurs Cisco)", padx=10, pady=10, bg="#34495e", fg="white", font=("Arial", 11, "bold"))
    frame_user.pack(fill="x", padx=15, pady=10)

    tk.Label(frame_user, text="Username:", bg="#34495e", fg="white").grid(row=0, column=0, sticky="w")
    global username_entry
    username_entry = tk.Entry(frame_user, width=20)
    username_entry.grid(row=0, column=1, padx=5)

    tk.Label(frame_user, text="Password:", bg="#34495e", fg="white").grid(row=1, column=0, sticky="w")
    global password_entry
    password_entry = tk.Entry(frame_user, show="*", width=20)
    password_entry.grid(row=1, column=1, padx=5)

    tk.Button(frame_user, text="Add User", command=add_user, bg="#27ae60", fg="white", font=("Arial", 10, "bold"), relief="raised").grid(row=2, column=0, columnspan=2, pady=8)
    tk.Button(frame_user, text="Show Users", command=show_users, bg="#8e44ad", fg="white", font=("Arial", 10, "bold"), relief="raised").grid(row=2, column=6, columnspan=2, pady=8)
    
    

    # --- Cadre SSH ---
    frame_ssh = tk.LabelFrame(root, text="🔑 SSH Control", padx=10, pady=10, bg="#34495e", fg="white", font=("Arial", 11, "bold"))
    frame_ssh.pack(fill="x", padx=15, pady=10)

    tk.Button(frame_ssh, text="Enable SSH", command=enable_ssh, bg="#2980b9", fg="white", font=("Arial", 10, "bold")).pack(side="left", padx=8)
    tk.Button(frame_ssh, text="Disable SSH", command=disable_ssh, bg="#c0392b", fg="white", font=("Arial", 10, "bold")).pack(side="left", padx=8)
    
    tk.Button(frame_ssh, text="SSH Status", command=show_ssh_status, bg="#e67e22", fg="white", font=("Arial", 10, "bold")).pack(side="left", padx=8)

    # --- Cadre Routing ---
    frame_routing = tk.LabelFrame(root, text="🌐 Routing Control", padx=10, pady=10, bg="#34495e", fg="white", font=("Arial", 11, "bold"))
    frame_routing.pack(fill="x", padx=15, pady=10)

    tk.Label(frame_routing, text="OSPF Process ID:", bg="#34495e", fg="white").grid(row=0, column=0, sticky="w")
    global ospf_process_entry
    ospf_process_entry = tk.Entry(frame_routing, width=10)
    ospf_process_entry.grid(row=0, column=1, padx=5)

    tk.Label(frame_routing, text="Network:", bg="#34495e", fg="white").grid(row=0, column=2, sticky="w")
    global ospf_network_entry
    ospf_network_entry = tk.Entry(frame_routing, width=15)
    ospf_network_entry.grid(row=0, column=3, padx=5)
    
    tk.Label(frame_routing, text="Mask:", bg="#34495e", fg="white").grid(row=0, column=4, sticky="w")
    global ospf_mask_entry
    ospf_mask_entry = tk.Entry(frame_routing, width=15)
    ospf_mask_entry.grid(row=0, column=5, padx=5)

    tk.Label(frame_routing, text="Area:", bg="#34495e", fg="white").grid(row=0, column=6, sticky="w")
    global ospf_area_entry
    ospf_area_entry = tk.Entry(frame_routing, width=10)
    ospf_area_entry.grid(row=0, column=7, padx=5)
    

    tk.Button(frame_routing, text="Configure OSPF", command=configure_ospf, bg="#16a085", fg="white", font=("Arial", 10, "bold")).grid(row=0, column=8, padx=5)
    tk.Button(frame_routing, text="Show OSPF", command=show_ospf, bg="#f39c12", fg="white", font=("Arial", 10, "bold")).grid(row=0, column=9, padx=5)
    
  

    tk.Label(frame_routing, text="EIGRP AS:", bg="#34495e", fg="white").grid(row=1, column=0, sticky="w")
    global eigrp_as_entry
    eigrp_as_entry = tk.Entry(frame_routing, width=10)
    eigrp_as_entry.grid(row=1, column=1, padx=5)

    tk.Label(frame_routing, text="Network:", bg="#34495e", fg="white").grid(row=1, column=2, sticky="w")
    global eigrp_network_entry
    eigrp_network_entry = tk.Entry(frame_routing, width=15)
    eigrp_network_entry.grid(row=1, column=3, padx=5)

    tk.Button(frame_routing, text="Disable EIGRP", command=disable_eigrp, bg="#c0392b", fg="white", font=("Arial", 10, "bold")).grid(row=1, column=4, padx=5)
    tk.Button(frame_routing, text="Configure EIGRP", command=configure_eigrp, bg="#2980b9", fg="white", font=("Arial", 10, "bold")).grid(row=1, column=5, padx=5)
    tk.Button(frame_routing, text="Show EIGRP", command=show_eigrp, bg="#d35400", fg="white", font=("Arial", 10, "bold")).grid(row=1, column=6, padx=5)

    # --- Cadre DMVPN ---
    frame_dmvpn = tk.LabelFrame(root, text="🌐 DMVPN Config", padx=10, pady=10, bg="#34495e", fg="white", font=("Arial", 11, "bold"))
    frame_dmvpn.pack(fill="x", padx=15, pady=10)

    # Champs
    fields = [
        ("Tunnel ID", 5), ("Description", 15), ("Tunnel IP", 15), ("Mask", 15),
        ("Tunnel Source", 15), ("NHRP Auth", 15), ("Bandwidth", 10), ("MTU", 10),
        ("NHRP Maps (comma)", 50), ("NHRP Holdtime", 5),
        ("NHS (comma)", 50), ("QoS", 15), ("Keepalive", 10), ("TCP MSS", 5),
        ("IPSec Profile", 15)
    ]

    entries = {}
    row = 0
    for label, width in fields:
        tk.Label(frame_dmvpn, text=f"{label}:", bg="#34495e", fg="white").grid(row=row//2, column=(row%2)*2, sticky="w")
        entry = tk.Entry(frame_dmvpn, width=width)
        entry.grid(row=row//2, column=(row%2)*2+1, padx=5, pady=2)
        entries[label] = entry
        row += 1

    # Hub/Spoke
    global hub_var
    hub_var = tk.StringVar(value="hub")
    tk.Radiobutton(frame_dmvpn, text="Hub", variable=hub_var, value="hub", bg="#34495e", fg="white").grid(row=8, column=0)
    tk.Radiobutton(frame_dmvpn, text="Spoke", variable=hub_var, value="spoke", bg="#34495e", fg="white").grid(row=8, column=1)

    # Pré-remplissages
    def fill_tunnel1():
        entries["Tunnel ID"].delete(0, tk.END); entries["Tunnel ID"].insert(0, "1")
        entries["Description"].delete(0, tk.END); entries["Description"].insert(0, "Agence-TT")
        entries["Tunnel IP"].delete(0, tk.END); entries["Tunnel IP"].insert(0, "10.111.11.1")
        entries["Mask"].delete(0, tk.END); entries["Mask"].insert(0, "255.255.0.0")
        entries["Tunnel Source"].delete(0, tk.END); entries["Tunnel Source"].insert(0, "Loopback0")
        entries["NHRP Auth"].delete(0, tk.END); entries["NHRP Auth"].insert(0, "@tt1j@r1")
        entries["Bandwidth"].delete(0, tk.END); entries["Bandwidth"].insert(0, "4000")
        entries["MTU"].delete(0, tk.END); entries["MTU"].insert(0, "1400")
        entries["NHRP Maps (comma)"].delete(0, tk.END)
        entries["NHRP Maps (comma)"].insert(0,
            "10.111.254.254 172.25.250.15, multicast 172.25.250.15"
        )
        entries["NHS (comma)"].delete(0, tk.END)
        entries["NHS (comma)"].insert(0, "10.111.254.254")

        entries["NHRP Holdtime"].delete(0, tk.END); entries["NHRP Holdtime"].insert(0, "60")
        entries["NHS (comma)"].delete(0, tk.END); entries["NHS (comma)"].insert(0, "10.111.254.254,10.111.253.253")
        entries["QoS"].delete(0, tk.END); entries["QoS"].insert(0, "pre-classify")
        entries["Keepalive"].delete(0, tk.END); entries["Keepalive"].insert(0, "10 3")
        entries["TCP MSS"].delete(0, tk.END); entries["TCP MSS"].insert(0, "1360")
        entries["IPSec Profile"].delete(0, tk.END); entries["IPSec Profile"].insert(0, "protect-gre")

    def fill_tunnel2():
        entries["Tunnel ID"].delete(0, tk.END); entries["Tunnel ID"].insert(0, "2")
        entries["Description"].delete(0, tk.END); entries["Description"].insert(0, "Agence-Ooredoo")
        entries["Tunnel IP"].delete(0, tk.END); entries["Tunnel IP"].insert(0, "10.112.11.1")
        entries["Mask"].delete(0, tk.END); entries["Mask"].insert(0, "255.255.0.0")
        entries["Tunnel Source"].delete(0, tk.END); entries["Tunnel Source"].insert(0, "Loopback0")   # <-- changement
        entries["NHRP Auth"].delete(0, tk.END); entries["NHRP Auth"].insert(0, "@tt1j@r1")
        entries["Bandwidth"].delete(0, tk.END); entries["Bandwidth"].insert(0, "10000")
        entries["MTU"].delete(0, tk.END); entries["MTU"].insert(0, "1400")
        entries["NHRP Maps (comma)"].delete(0, tk.END)
        entries["NHRP Maps (comma)"].insert(0,
            "10.112.254.254 172.25.250.215, multicast 172.25.250.215"
        )
        entries["NHRP Holdtime"].delete(0, tk.END); entries["NHRP Holdtime"].insert(0, "60")
        entries["NHS (comma)"].delete(0, tk.END); entries["NHS (comma)"].insert(0, "10.112.254.254")
        entries["QoS"].delete(0, tk.END); entries["QoS"].insert(0, "pre-classify")
        entries["Keepalive"].delete(0, tk.END); entries["Keepalive"].insert(0, "10 3")
        entries["TCP MSS"].delete(0, tk.END); entries["TCP MSS"].insert(0, "1360")
        entries["IPSec Profile"].delete(0, tk.END); entries["IPSec Profile"].insert(0, "protect-gre")

    def fill_tunnel3():
        entries["Tunnel ID"].delete(0, tk.END); entries["Tunnel ID"].insert(0, "3")
        entries["Description"].delete(0, tk.END); entries["Description"].insert(0, "Agence-Orange")
        entries["Tunnel IP"].delete(0, tk.END); entries["Tunnel IP"].insert(0, "10.113.8.1")
        entries["Mask"].delete(0, tk.END); entries["Mask"].insert(0, "255.255.0.0")
        entries["Tunnel Source"].delete(0, tk.END); entries["Tunnel Source"].insert(0, "Loopback0")   # <-- changement
        entries["NHRP Auth"].delete(0, tk.END); entries["NHRP Auth"].insert(0, "@tt1j@r1")
        entries["Bandwidth"].delete(0, tk.END); entries["Bandwidth"].insert(0, "4000")
        entries["MTU"].delete(0, tk.END); entries["MTU"].insert(0, "1400")
        entries["NHRP Maps (comma)"].delete(0, tk.END)
        entries["NHRP Maps (comma)"].insert(0,
            "10.113.254.254 172.25.250.115, multicast 172.25.250.115"
        )
        entries["NHRP Holdtime"].delete(0, tk.END); entries["NHRP Holdtime"].insert(0, "60")
        entries["NHS (comma)"].delete(0, tk.END); entries["NHS (comma)"].insert(0, "10.113.254.254")
        entries["QoS"].delete(0, tk.END); entries["QoS"].insert(0, "pre-classify")
        entries["Keepalive"].delete(0, tk.END); entries["Keepalive"].insert(0, "10 3")
        entries["TCP MSS"].delete(0, tk.END); entries["TCP MSS"].insert(0, "1360")
        entries["IPSec Profile"].delete(0, tk.END); entries["IPSec Profile"].insert(0, "protect-gre")

    tk.Button(frame_dmvpn, text="Tunnel1", command=fill_tunnel1, bg="#3498db", fg="white").grid(row=10, column=0, pady=5)
    tk.Button(frame_dmvpn, text="Tunnel2", command=fill_tunnel2, bg="#9b59b6", fg="white").grid(row=10, column=1, pady=5)
    tk.Button(frame_dmvpn, text="Tunnel3", command=fill_tunnel3, bg="#e67e22", fg="white").grid(row=10, column=2, pady=5)
    tk.Button(frame_dmvpn, text="Configure Tunnel", command=configure_dmVPN, bg="#16a085", fg="white", font=("Arial", 10, "bold")).grid(row=11, column=0, columnspan=2, pady=10)
    tk.Button(frame_dmvpn, text="Disable DMVPN", command=disable_dmVPN, bg="#c0392b", fg="white", font=("Arial", 10, "bold")).grid(row=11, column=2, columnspan=2, pady=10)
    tk.Button(frame_dmvpn, text="Show DMVPN", command=show_dmVPN, bg="#f39c12", fg="white", font=("Arial", 10, "bold")).grid(row=11, column=4, padx=10, pady=10)

    # --- Output console ---
    frame_output = tk.LabelFrame(root, text="📜 Output Console", padx=10, pady=10, bg="#34495e", fg="white", font=("Arial", 11, "bold"))
    frame_output.pack(fill="both", expand=True, padx=15, pady=10)

    global output_text
    output_text = scrolledtext.ScrolledText(frame_output, wrap=tk.WORD, width=85, height=20, bg="black", fg="lime", insertbackground="white")
    output_text.pack(fill="both", expand=True)

    root.mainloop()

# ========= MAIN =========
if __name__ == "__main__":
    init_db()
    app = LoginWindow()
    app.mainloop()

