#include "reclamation.h"
#include <QtSql>

reclamation::reclamation()
{
    id_rec=0;
    id_patient=0;
    sujet="";
}

reclamation::reclamation(int id_rec, QString sujet, int id_patient)
{
    this->id_rec = id_rec;
    this->sujet = sujet;
    this->id_patient = id_patient;

}

bool reclamation::ajouter()
{
    QSqlQuery query;
    query.prepare("INSERT INTO RECLAMATION (id_rec, sujet, id_patient) "
                  "VALUES (:id_rec, :sujet, :id_patient)");
    query.bindValue(":id_rec", id_rec);
    query.bindValue(":sujet", sujet);

    query.bindValue(":id_patient", id_patient);
    return query.exec();
}

QSqlQueryModel *reclamation::afficher()
{
 QSqlQueryModel *model=new QSqlQueryModel();
 model->setQuery("select *from reclamation");
 model->setHeaderData(0, Qt::Horizontal,QObject::tr("id_rec"));
  model->setHeaderData(1, Qt::Horizontal,QObject::tr("sujet"));
 model->setHeaderData(2, Qt::Horizontal,QObject::tr("id_patient"));

 return model;
}

bool reclamation::supprimer(int cc)
{
    QSqlQuery query;
    QString res=QString::number(cc);
    query.prepare("Delete from reclamation where id_rec = :id_rec ");
    query.bindValue(":id_rec",res);
    return query.exec();

}
bool reclamation::modifier(int id_rec, QString sujet, int id_patient)
{
    QSqlQuery qry;
    qry.prepare("UPDATE reclamation SET sujet = :sujet, id_patient = :id_patient WHERE id_rec = :id_rec");

    qry.bindValue(":id_rec", id_rec);
    qry.bindValue(":sujet", sujet);
    qry.bindValue(":id_patient", id_patient);

    return qry.exec();
}

void reclamation::rechercher(QTableView *table, QString cas)
{
    QSqlQueryModel *model = new QSqlQueryModel();
    QSqlQuery *query = new QSqlQuery;

    query->prepare("SELECT * FROM reclamation WHERE id_rec = :id_rec");
    query->bindValue(":id_rec", cas.toInt()); // Supposant que le code est de type entier

    if (query->exec())
    {
        model->setQuery(*query);
        table->setModel(model);
        table->show();
    }
    else
    {
        qDebug() << "Erreur lors de l'exécution de la requête :" << query->lastError().text();
    }
}
