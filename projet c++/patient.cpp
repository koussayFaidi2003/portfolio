#include "patient.h"
#include <QCheckBox>
#include <QTableView>
#include <QDebug>
#include <QStandardItemModel>

Patient::Patient(QString nom,QString prenom,int num,QDate dateN,QString adress,QString typeRed)
{
   this->nom=nom;
   this->prenom=prenom;
   this->num=num;
   this->dateN=dateN;
   this->adress=adress;
   this->typeRed=typeRed;
}

//getters
int Patient::getId(){
    return id;
}
QString Patient::getNom(){
    return nom;
}
QString Patient::getPrenom(){
    return prenom;
}
QString Patient::getTypeRed(){
    return typeRed;
}
QString Patient::getAdress(){
    return adress;
}
int Patient::getNum(){
    return num;
}
QDate Patient::getDate(){
    return dateN;
}

//setters
void Patient::setID(int n){
    id=n;
}
void Patient::setNom(QString n){
    nom=n;
}
void Patient::setPrenom(QString n){
    prenom=n;
}
void Patient::setTypeRed(QString n){
    typeRed=n;
}
void Patient::setAdress(QString n){
    adress=n;
}
void Patient::setNum(int n){
    num=n;
}
void Patient::setDate(QDate n){
    dateN=n;
}

//CRUD
bool Patient::ajouter() {
    QSqlQuery query;

    // Check if the patient already exists
    query.prepare("SELECT COUNT(*) FROM patients WHERE nom = :nom AND prenom = :prenom AND num = :num AND date_naissance = :dateN");
    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":num", num);
    query.bindValue(":dateN", dateN);
    query.exec();

    if (query.next()) {
        int count = query.value(0).toInt();
        if (count > 0) {
            // If the patient already exists, update the number of occurrences
            query.prepare("UPDATE patients SET nb_occurrence = nb_occurrence + 1, type_reeducation = :type_red, adresse = :adress WHERE nom = :nom AND prenom = :prenom AND num = :num AND date_naissance = :dateN");
            query.bindValue(":nom", nom);
            query.bindValue(":prenom", prenom);
            query.bindValue(":num", num);
            query.bindValue(":adress", adress);
            query.bindValue(":type_red", typeRed);
            query.bindValue(":dateN", dateN);
            if (!query.exec()) {
                return false;
            }
            return true;
        }
    }

    // If the patient does not exist, insert a new record
    query.prepare("INSERT INTO patients(nom, prenom, num, adresse, type_reeducation, date_naissance, nb_occurrence) VALUES (:nom, :prenom, :num, :adress, :type_red, :dateN, 1)");
    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":num", num);
    query.bindValue(":adress", adress);
    query.bindValue(":type_red", typeRed);
    query.bindValue(":dateN", dateN);

    return query.exec();
}


bool Patient::supprimer(QStandardItemModel *model){
    QSqlQuery query;

    for(int row = 0; row < model->rowCount(); ++row) {

        QStandardItem *checkboxItem = model->item(row, 7);
        if(checkboxItem->checkState() == Qt::Checked) {

            QString id = model->item(row, 0)->text();

            query.prepare("delete from patients where id_patient = :id");
            query.bindValue(":id", id);


            if(!query.exec()) {
                // If query execution fails, return false
                return false;
            }
        }
    }

    // If all deletions were successful, return true
    return true;
}


QStandardItemModel * Patient::afficher(){
    QSqlQuery query;
    query.prepare("select * from patients");
    query.exec();

    QStandardItemModel *model = new QStandardItemModel();

    model->setColumnCount(7);
    model->setHorizontalHeaderLabels(QStringList() << "ID_PATIENT" << "NOM" << "PRENOM" << "NUM" << "DATE_NAISSANCE" << "ADRESSE" << "TYPE_REEDUCATION" << "SELECT");

    int row = 0;
    while(query.next()) {
        for(int column = 0; column < 7; ++column) {
            QString value = query.value(column).toString();
            QStandardItem *item = new QStandardItem(value);
            model->setItem(row, column, item);
        }

        // Add a checkbox as the last column
        QStandardItem *checkboxItem = new QStandardItem();
        checkboxItem->setCheckable(true);
        model->setItem(row, 7, checkboxItem);

        row++;
    }

    return model;
}

bool Patient::modifier(QStandardItemModel *model){
    QSqlQuery query;

    for(int row = 0; row < model->rowCount(); ++row) {
    QStandardItem *checkboxItem = model->item(row, 7);
    if(checkboxItem->checkState() == Qt::Checked){
    QString id = model->item(row, 0)->text();

    // Update the patient's information in the database
    query.prepare("UPDATE patients SET nom = :nom, prenom = :prenom, num = :num, adresse = :adress, type_reeducation = :type_red, date_naissance = :dateN WHERE id_patient = :id");
    query.bindValue(":nom", nom);
    query.bindValue(":prenom", prenom);
    query.bindValue(":num", num);
    query.bindValue(":adress", adress);
    query.bindValue(":type_red", typeRed);
    query.bindValue(":dateN", dateN);
    query.bindValue(":id", id);

    }
    // Execute the update query
    }
    return query.exec();
}

QChartView *Patient::afficher_Stats() {
    QSqlQuery query;
    query.prepare("SELECT type_reeducation, COUNT(type_reeducation) AS Count FROM patients GROUP BY type_reeducation");
    query.exec();

    QPieSeries *series = new QPieSeries();

    while (query.next()) {
        QString type = query.value(0).toString();
        int count = query.value(1).toInt();
        series->append(type, count);
    }

    QChart *chart = new QChart();
    chart->setTitle("Distribution of Types of Reeducation");

    chart->addSeries(series);
    chart->legend()->setVisible(true);
    chart->legend()->setAlignment(Qt::AlignBottom);

    QChartView *chartView = new QChartView(chart);
    chartView->setRenderHint(QPainter::Antialiasing);

    return chartView;
}

void Patient::displayChartView() {
    QChartView *chartView = afficher_Stats();
    chartView->resize(1500,800);
    chartView->show();
}

QChartView *Patient::afficher_Top3_Customers() {
    QSqlQuery query;
    query.prepare("SELECT nom, prenom, nb_occurrence FROM (SELECT nom, prenom, nb_occurrence FROM patients ORDER BY nb_occurrence DESC) WHERE ROWNUM <= 5");
    query.exec();

    QBarSet *barSet = new QBarSet("Occurrence Count");
    QStringList categories;

    while (query.next()) {
        QString nom = query.value(0).toString();
        QString prenom = query.value(1).toString();
        int occurrence_count = query.value(2).toInt();
        QString patientName = nom + " " + prenom;
        qDebug() << "Patient Name:" << patientName;
        *barSet << occurrence_count;
        categories << patientName;
    }

    QBarSeries *series = new QBarSeries();
    series->append(barSet);

    QChart *chart = new QChart();
    chart->setTitle("Top Patients");
    chart->addSeries(series);

    // Create and set the X axis
    QBarCategoryAxis *axisX = new QBarCategoryAxis();
    axisX->append(categories);
    chart->addAxis(axisX, Qt::AlignBottom);
    series->attachAxis(axisX);

    chart->createDefaultAxes();
    chart->legend()->setVisible(true);
    chart->legend()->setAlignment(Qt::AlignBottom);

    QChartView *chartView = new QChartView(chart);
    chartView->setRenderHint(QPainter::Antialiasing);

    return chartView;
}

void Patient::displayChartViewTop3Customers(){
    QChartView *chartView = afficher_Top3_Customers();
    chartView->resize(1500,800);
    chartView->show();
}

