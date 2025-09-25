import os
import csv
import re

# Dossier où sont stockés les fichiers ping
ping_dir = "raw_outputs/ping"

# Nom du fichier CSV final
csv_file = "raw_outputs/ping_summary.csv"

# Liste pour stocker toutes les données
data = []

# Parcours tous les fichiers ping_*.txt
for filename in os.listdir(ping_dir):
    if filename.startswith("ping_") and filename.endswith(".txt"):
        filepath = os.path.join(ping_dir, filename)
        with open(filepath, "r") as f:
            content = f.read()
            # Extraire la latence et le taux de perte
            loss_match = re.search(r'Loss:\s*(\d+)%', content)
            latency_match = re.search(r'Avg latency:\s*([\d\.]+)', content)
            loss = loss_match.group(1) if loss_match else "N/A"
            latency = latency_match.group(1) if latency_match else "N/A"
            
            # Extraire source et destination à partir du nom du fichier
            parts = filename.replace(".txt","").split("_")
            src = parts[1]
            dst = parts[2]
            
            # Ajouter à la liste
            data.append([src, dst, latency, loss])

# Écriture dans le CSV
with open(csv_file, "w", newline="") as f:
    writer = csv.writer(f)
    writer.writerow(["source", "destination", "avg_latency_ms", "packet_loss_%"])
    writer.writerows(data)

print(f"CSV créé avec succès : {csv_file}")
