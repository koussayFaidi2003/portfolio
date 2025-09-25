#ifndef EQUIPEMENT_H
#define EQUIPEMENT_H
#include <QDialog>
#include<QSqlQuery>
#include <QString>
#include <QSqlQuery>
#include <QtDebug>
#include <QSqlQueryModel>
#include <QTableView>
#include <QStandardItemModel>
#include <QtCharts>
#include <QtCharts/QChartView>
#include <QtCharts/QPieSeries>
#include <QtCharts/QPieSlice>
class Equipement
{
    QString TYPE_CAT;
    int CODE, ID_FOURNISSEUR, QUANTITE, ARG_UNIT, ARG_TOT;

public:
    Equipement();
    Equipement(int, int, int, QString, int, int);
    QSqlQueryModel * calculerStatistiquesSalaireMoyenParFonction();
    QString getTYPE_CAT() const { return TYPE_CAT; }
    int getCODE() const { return CODE; }
    int getID_FOURNISSEUR() const { return ID_FOURNISSEUR; }
    int getQUANTITE() const { return QUANTITE; }
    int getARG_UNIT() const { return ARG_UNIT; }
    int getARG_TOT() const { return ARG_TOT; }
QChartView * afficher_Stats_equip();
    void setTYPE_CAT(const QString &t) { TYPE_CAT = t; }
    void setCODE(int code) { CODE = code; }
    void setID_FOURNISSEUR(int id) { ID_FOURNISSEUR = id; }
    void setQUANTITE(int quantite) { QUANTITE = quantite; }
    void setARG_UNIT(int argUnit) { ARG_UNIT = argUnit; }
    void setARG_TOT(int argTot) { ARG_TOT = argTot; }
void afficherHistorique();
    bool ajouter();
    QSqlQueryModel *afficher();
    bool supprimer(int);
    bool modifier(int,int,int,QString,int,int);
    void rechercher(QTableView *table,QString cas );
    bool reset();
    void genererqr(QString data);
};

#endif // EQUIPEMENT_H
