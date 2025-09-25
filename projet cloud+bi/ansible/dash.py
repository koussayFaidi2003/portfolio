import sqlite3
import pandas as pd
import streamlit as st
import plotly.express as px
from datetime import datetime

# Connexion à la base SQLite
conn = sqlite3.connect("network_metrics.db")

# ---- CONFIG DASHBOARD ----
st.set_page_config(
    page_title="Supervision Réseau",
    page_icon="📡",
    layout="wide",
    initial_sidebar_state="expanded"
)

# ---- SIDEBAR ----
st.sidebar.title("Filtres")
tab_choice = st.sidebar.radio("Sélectionner la vue :", ["Ping / Latence", "OSPF"])

# Optionnel : filtrer par source ou destination
df_ping = pd.read_sql("SELECT * FROM ping", conn)
sources = df_ping['source'].unique()
destinations = df_ping['destination'].unique()
source_filter = st.sidebar.multiselect("Source", sources, default=list(sources))
dest_filter = st.sidebar.multiselect("Destination", destinations, default=list(destinations))
df_ping_filtered = df_ping[df_ping['source'].isin(source_filter) & df_ping['destination'].isin(dest_filter)]

df_ospf = pd.read_sql("SELECT * FROM ospf", conn)

conn.close()

# ---- HEADER ----
st.title("📡 Dashboard Supervision Réseau")
st.markdown("""
**Visualisation des métriques réseau : Latence, Perte de paquets et état des voisins OSPF**
""")

# ---- VUES ----
if tab_choice == "Ping / Latence":
    st.subheader("📊 Latences et pertes de paquets")

    # KPI rapides
    col1, col2, col3 = st.columns(3)
    col1.metric("Latence moyenne (ms)", round(df_ping_filtered['avg_latency_ms'].mean(),2))
    col2.metric("Perte moyenne (%)", round(df_ping_filtered['packet_loss'].mean(),2))
    col3.metric("Nombre de liens monitorés", df_ping_filtered.shape[0])

    # Graphiques
    fig_latency = px.bar(
        df_ping_filtered, x="source", y="avg_latency_ms",
        color="destination", barmode="group",
        title="Latence moyenne par lien",
        labels={"avg_latency_ms": "Latence (ms)"}
    )
    fig_latency.update_layout(title_x=0.5, plot_bgcolor="#f9f9f9")
    st.plotly_chart(fig_latency, use_container_width=True)

    fig_loss = px.bar(
        df_ping_filtered, x="source", y="packet_loss",
        color="destination", barmode="group",
        title="Taux de perte par lien",
        labels={"packet_loss": "Perte (%)"}
    )
    fig_loss.update_layout(title_x=0.5, plot_bgcolor="#f9f9f9")
    st.plotly_chart(fig_loss, use_container_width=True)

elif tab_choice == "OSPF":
    st.subheader("🖧 Voisins OSPF")
    st.dataframe(df_ospf.style.highlight_max(subset=['state'], color='lightgreen'))

    # Graphique état OSPF
    ospf_count = df_ospf.groupby(['router','state']).size().reset_index(name='count')
    fig_ospf = px.bar(
        ospf_count, x="router", y="count", color="state",
        title="État des voisins OSPF",
        labels={"count":"Nombre de voisins"}
    )
    fig_ospf.update_layout(title_x=0.5, plot_bgcolor="#f9f9f9")
    st.plotly_chart(fig_ospf, use_container_width=True)

# ---- FOOTER ----
st.markdown("---")
st.markdown(f"Dashboard mis à jour le : {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}")

