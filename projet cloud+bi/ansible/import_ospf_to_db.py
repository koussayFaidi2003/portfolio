import os
import sqlite3
import re

ospf_dir = "raw_outputs/ospf"
conn = sqlite3.connect("network_metrics.db")
cursor = conn.cursor()

for filename in os.listdir(ospf_dir):
    if filename.endswith(".txt"):
        router = filename.split("_")[0]
        with open(os.path.join(ospf_dir, filename), "r") as f:
            for line in f:
                # Exemple très simple : parser "Neighbor ID" et "State"
                m = re.match(r'(\d+\.\d+\.\d+\.\d+)\s+(\w+)\s+(\S+)', line)
                if m:
                    neighbor, state, interface = m.groups()
                    cursor.execute(
                        "INSERT INTO ospf (router, neighbor, state, interface) VALUES (?, ?, ?, ?)",
                        (router, neighbor, state, interface)
                    )

conn.commit()
conn.close()
print("Données OSPF importées avec succès !")
