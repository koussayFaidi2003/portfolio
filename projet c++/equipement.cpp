#include "equipement.h"
#include <QDebug>
#include <QSqlError>
#include "QSqlQuery"
#include "QtDebug"
#include"QObject"
#include "connection.h"
#include <QSqlError>
#include <QDate>
#include <QSqlQuery>
#include <QVariant>
#include "QZXing.h"
Equipement::Equipement()
{
    CODE = 0;
    ID_FOURNISSEUR = 0;
   QUANTITE = 0;
    TYPE_CAT = " ";
    ARG_UNIT = 0;
    ARG_TOT = 0;
}
Equipement::Equipement(int CODE, int ID_FOURNISSEUR, int QUANTITE, QString TYPE_CAT, int ARG_UNIT, int ARG_TOT)
{
    this->CODE = CODE;
    this->ID_FOURNISSEUR = ID_FOURNISSEUR;
    this->QUANTITE = QUANTITE;
    this->TYPE_CAT = TYPE_CAT;
    this->ARG_UNIT = ARG_UNIT;
    this->ARG_TOT = ARG_TOT;
}


bool Equipement::ajouter()
{
    QSqlQuery query;
    query.prepare("INSERT INTO EQUIPEMENT (CODE, ID_FOURNISSEUR, QUANTITE, TYPE_CAT, ARG_UNIT, ARG_TOT) "
                  "VALUES (:CODE, :ID_FOURNISSEUR, :QUANTITE, :TYPE_CAT, :ARG_UNIT, :ARG_TOT)");
    query.bindValue(":CODE", CODE);
    query.bindValue(":ID_FOURNISSEUR", ID_FOURNISSEUR);
    query.bindValue(":QUANTITE", QUANTITE);
    query.bindValue(":TYPE_CAT", TYPE_CAT);
    query.bindValue(":ARG_UNIT", ARG_UNIT);
    query.bindValue(":ARG_TOT", ARG_TOT);

    return query.exec();
}

QSqlQueryModel *Equipement::afficher()
{
 QSqlQueryModel *model=new QSqlQueryModel();
 model->setQuery("select *from Equipement");
 model->setHeaderData(0, Qt::Horizontal,QObject::tr("CODE"));
 model->setHeaderData(1, Qt::Horizontal,QObject::tr("ID_FOURNISSEUR"));
 model->setHeaderData(2, Qt::Horizontal,QObject::tr("QUANTITE"));
 model->setHeaderData(3, Qt::Horizontal,QObject::tr("TYPE_CAT"));
  model->setHeaderData(4, Qt::Horizontal,QObject::tr("ARG_UNIT"));
model->setHeaderData(5, Qt::Horizontal,QObject::tr("ARG_TOT"));
 return model;
}
bool Equipement::supprimer(int cc)
{
    QSqlQuery query;
    QString res=QString::number(cc);
    query.prepare("Delete from Equipement where CODE = :CODE ");
    query.bindValue(":CODE",res);
    return query.exec();

}
bool Equipement::modifier(int CODE,int ID_FOURNISSEUR,int QUANTITE,QString TYPE_CAT,int ARG_UNIT,int ARG_TOT)
{

    QSqlQuery qry;
        qry.prepare("UPDATE Equipement set ID_FOURNISSEUR=(?),QUANTITE=(?),TYPE_CAT=(?),ARG_UNIT=(?),ARG_TOT=(?) where CODE=(?) ");



        qry.addBindValue(ID_FOURNISSEUR);
        qry.addBindValue(QUANTITE);
        qry.addBindValue(TYPE_CAT);
         qry.addBindValue(ARG_UNIT);
         qry.addBindValue(ARG_TOT);
         qry.addBindValue(CODE);

   return  qry.exec();
}
void Equipement::rechercher(QTableView *table, QString cas)
{
    QSqlQueryModel *model = new QSqlQueryModel();
    QSqlQuery *query = new QSqlQuery;

    query->prepare("SELECT * FROM Equipement WHERE CODE = :code");
    query->bindValue(":code", cas.toInt()); // Supposant que le code est de type entier

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

bool Equipement::reset()
{
   QSqlQuery query;
        query.prepare("delete Equipement suivi");
        query.bindValue(0, CODE);
     return query.exec();
}

QSqlQueryModel* Equipement::calculerStatistiquesSalaireMoyenParFonction() {
    QSqlQueryModel* model = new QSqlQueryModel();
    QSqlQuery query("SELECT AVG(ARG_TOT) AS ARG_TOT FROM EQUIPEMENT");
    model->setQuery(query);
    return model;
}

void Equipement::afficherHistorique() {
    QFile historyFile("C:/Users/21692/Desktop/projet c++/Historique.txt");
    if (historyFile.open(QIODevice::ReadOnly | QIODevice::Text)) {
        QTextStream in(&historyFile);
        QString historiqueContenu = in.readAll();
        historyFile.close();

        // Displaying the history in a dialog
        QDialog* historiqueDialog = new QDialog(nullptr);
        historiqueDialog->setWindowTitle("Historique");
        historiqueDialog->setMinimumSize(500, 500);

        QTextEdit* textEdit = new QTextEdit(historiqueDialog);
        textEdit->setHtml("<div style='font-family: Arial, sans-serif; font-size: 12px;'>" + historiqueContenu + "</div>");
        textEdit->setReadOnly(true);

        QVBoxLayout* layout = new QVBoxLayout(historiqueDialog);
        layout->addWidget(textEdit);

        historiqueDialog->exec();
    } else {
        QMessageBox::warning(nullptr, "Erreur", "Impossible d'ouvrir le fichier d'historique pour la lecture.");
    }
}
void Equipement::genererqr(QString data)
{

    QString filePath ="C:/Users/21692/Desktop/projet c++/qr_equip.png";
       QImage qr = QZXing::encodeData(data);
       if (!qr.isNull())
       {
              if (qr.save(filePath))
              {
                  qDebug() << "QR code saved to:" << filePath;

              }
              else
              {
                  qDebug() << "Failed to save QR code to file!";
              }
       }
       else
       {
              qDebug() << "Failed to generate QR code!";
       }
}
