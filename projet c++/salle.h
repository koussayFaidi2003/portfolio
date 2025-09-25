#ifndef SALLE_H
#define SALLE_H

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

class salle
{
    int num;
    QString DISPONABILOTE;

public:
    salle();
    bool ajouter();
    QSqlQueryModel *afficher();
    bool supprimer(int);
    bool modifier(int,QString,int);
    void rechercher(QTableView *table,QString cas );
};

#endif // SALLE_H
