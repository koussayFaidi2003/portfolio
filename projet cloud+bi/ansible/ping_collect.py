import subprocess
import re
import os

# Liste des PCs
pcs = ['192.168.1.10', '192.168.2.10', '192.168.3.10']

# Crée le dossier de sortie s'il n'existe pas
os.makedirs("raw_outputs/ping", exist_ok=True)

# Ping entre tous les PCs
for src in pcs:
    for dst in pcs:
        if src != dst:
            # Exécute le ping (5 paquets)
            p = subprocess.run(['ping', '-c', '5', dst], capture_output=True, text=True)
            output = p.stdout
            
            # Extraire le taux de perte
            loss_match = re.search(r'(\d+)% packet loss', output)
            loss = loss_match.group(1) if loss_match else "N/A"
            
            # Extraire la latence moyenne
            avg_match = re.search(r'rtt min/avg/max/mdev = [\d\.]+/([\d\.]+)/', output)
            avg = avg_match.group(1) if avg_match else "N/A"
            
            # Sauvegarde dans raw_outputs/ping/
            filename = f"raw_outputs/ping/ping_{src}_{dst}.txt"
            with open(filename, "w") as f:
                f.write(f"Loss: {loss}%\nAvg latency: {avg} ms\n")

            print(f"Ping de {src} vers {dst} enregistré dans {filename}")

