#include "modifier.h"
#include "ui_modifier.h"
#include "patient.h"
#include <QtSql>
#include "connection.h"


Modifier::Modifier(QStandardItemModel *model, QWidget *parent) :
    QDialog(parent),
    ui(new Ui::Modifier),
    model(model)
{
    ui->setupUi(this);
}

Modifier::~Modifier() {
    delete ui;
}

void Modifier::setPatient(Patient &s) { // Change to pass by reference
    s.setNom(ui->lineEditNom_Mod->text());
    s.setPrenom(ui->lineEditPrenom_Mod->text());
    s.setNum(ui->lineEditTel_Mod->text().toInt());
    s.setTypeRed(ui->lineEditTypeRed_Mod->text());
    s.setAdress(ui->lineEditAdress_Mod->text());
    s.setDate(ui->dateEditDateN_Mod->date());
}

void Modifier::on_pushButton_Ajouter_Mod_clicked() {
    QString nom = ui->lineEditNom_Mod->text();
    QString prenom = ui->lineEditPrenom_Mod->text();
    int num = ui->lineEditTel_Mod->text().toInt();
    QDate dateN = ui->dateEditDateN_Mod->date();
    QString adress = ui->lineEditAdress_Mod->text();
    QString typeRed = ui->lineEditTypeRed_Mod->text();

    Patient t(nom, prenom, num, dateN, adress, typeRed);

    bool test = t.modifier(model);

    if(test){
        QMessageBox::information(nullptr, QObject::tr("Successful"),
                                 QObject::tr("Modification effectué\n"
                                 "Click Cancel to exit."), QMessageBox::Cancel);
        ui->lineEditNom_Mod->clear();
        ui->lineEditPrenom_Mod->clear();
        ui->lineEditTel_Mod->clear();
        ui->dateEditDateN_Mod->clear();
        ui->lineEditAdress_Mod->clear();
        ui->lineEditTypeRed_Mod->clear();
        close();
    }
    else{
        QMessageBox::critical(nullptr, QObject::tr("Declined"),
                             QObject::tr("Modification non effectue.\n"
                                         "Click Cancel to exit."),QMessageBox::Cancel);
        close();
    }
}
