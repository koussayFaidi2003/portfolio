import sqlite3

# Créer/ouvrir la base
conn = sqlite3.connect("network_metrics.db")
cursor = conn.cursor()

# Table pour les pings
cursor.execute("""
CREATE TABLE IF NOT EXISTS ping (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    source TEXT,
    destination TEXT,
    avg_latency_ms REAL,
    packet_loss REAL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
)
""")

# Table pour OSPF
cursor.execute("""
CREATE TABLE IF NOT EXISTS ospf (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    router TEXT,
    neighbor TEXT,
    state TEXT,
    interface TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
)
""")

conn.commit()
conn.close()
print("Base et tables créées avec succès !")
