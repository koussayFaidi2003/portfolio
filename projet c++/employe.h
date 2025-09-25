#ifndef EMPLOYE_H
#define EMPLOYE_H
#include<QString>
#include<QSqlQueryModel>
#include <QSqlQuery>
#include <QObject>
#include <QDate>
#include<QTableView>

class Employe
        {
        public:
    Employe(){};
            Employe(QString nom, QString prenom, QString DateN, QString fonction, QString cin, int Num, QString salaire);


             int getid(){return id;}
             QString getnom();
             QString getprenom();
             QString getDateN();
              QString getsalaire();
             QString getfonction();
             QString getcin();
             int getNum();
             void setid(int id){this->id=id;}
            void setcin(QString);
            void setNum(int);
            void setnsalaire(QString);
            void setnom(QString);
            void setprenom(QString);
            void setfonction(QString);
           void setDateN(QString);
          bool ajouter();
            bool modifier( QString nouveauNom, QString nouveauPrenom,int idd,QString date,QString nouvcin, QString nouvfonction, int num, QString nouvsalaire);
            QSqlQueryModel* afficher();
            QSqlQueryModel* rechercherParCin(QString cin);
            bool supprimer(int);
    QSqlQueryModel* trierNomsAZ();
    QSqlQueryModel* calculerStatistiquesSalaireMoyenParFonction();

void genererqr(QString);




        private:
            int id,Num;

            QString cin,nom,prenom,fonction,salaire,DateN;

        };

#endif // EMPLOYE_H
