#ifndef RECLAMATION_H
#define RECLAMATION_H

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

class reclamation
{
    int id_rec,id_patient;
    QString sujet;
public:
    reclamation();
    reclamation(int,QString,int);
    bool ajouter();
    QSqlQueryModel *afficher();
    bool supprimer(int);
    bool modifier(int,QString,int);
    void rechercher(QTableView *table,QString cas );
};

#endif // RECLAMATION_H
