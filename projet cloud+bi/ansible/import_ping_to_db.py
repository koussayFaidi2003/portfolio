import pandas as pd
import sqlite3

# Lire le CSV généré précédemment
df = pd.read_csv("raw_outputs/ping_summary.csv")
# Renommer la colonne
df.rename(columns={"packet_loss_%": "packet_loss"}, inplace=True)

# Insérer dans SQLite
conn = sqlite3.connect("network_metrics.db")
df.to_sql("ping", conn, if_exists="append", index=False)
conn.close()
print("Données ping importées avec succès !")
