#include <QtSql>
#include "email.h"
#include "arduino.h"
#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "patient.h"
#include <QMessageBox>
#include "modifier.h"
#include <QSortFilterProxyModel>
#include <QWidget>
#include"employe.h"
#include "equipement.h"
#include "QDateEdit"
#include <QIntValidator>
#include "connection.h"
#include <QScrollBar>
#include <qfiledialog.h>
#include <QtPrintSupport/QPrinter>
#include <QtPrintSupport/QPrintDialog>
#include <QTextDocument>
#include <QTextStream>
#include <QDate>
#include <QComboBox>
#include <QTableView>
#include <QSqlDatabase>
#include <QDebug>
#include <QDesktopServices>
#include <QUrl>
#include <QProcess>
#include <QAxObject>
#include <QFileDialog>
#include <QMessageBox>
#include <connection.h>
#include <QFileDialog>
#include <QMessageBox>
#include <QPixmap>
#include <QSqlRecord>
#include <QFileDialog>
#include <QTextDocument>
#include <QTextCursor>
#include <QPrinter>
#include <QMessageBox>
#include <QWidget>
#include<QMainWindow>
#include"client.h"
#include<QAxObject>
#include<QWidget>
#include <QtPrintSupport/QPrinter>
#include <QTextDocument>
#include <QFileDialog>
#include <QTextTable>
#include <QtPrintSupport/QPrinterInfo>
#include <QPainter>
#include "mainwindow.h"
#include "notifymanager.h"
#include <QPushButton>

MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::MainWindow)
{

    ui->setupUi(this);
    /*int ret=a.connect_arduino();
    switch(ret)
    {
        case 0:
            qDebug() << "arduino is available and connected to: " << a.getarduino_port_name();
            break;
        case 1:
            qDebug() << "arduino is available but not connected to: " << a.getarduino_port_name();
            break;
        case -1:
            qDebug() << "arduino is not available";
    }
    connect(&a.getserial(), SIGNAL(readyRead()), this, SLOT(update_label()));*/
    connect(ui->comboBox_Sort, QOverload<int>::of(&QComboBox::currentIndexChanged), this, &MainWindow::on_comboBox_Sort_currentIndexChanged);
    connect(ui->lineEdit_Search, &QLineEdit::textChanged, this, &MainWindow::on_lineEdit_Search_textChanged);
    //connect(ui->lineEdit_Search_Stats, &QLineEdit::textChanged, this, &MainWindow::on_lineEdit_Search_Stats_textChanged);
    alarm = new ClickableLabel(this);
    QPixmap pixmap(":/new/prefix1/alarm-button (3).png");
    alarm->setPixmap(pixmap);
    alarm->setGeometry(1400, 80, 100, 100);
    alarm->setCursor(Qt::PointingHandCursor);
connect(ui->calendarWidget, &QCalendarWidget::clicked, this, &MainWindow::on_calendarWidget_clicked);
    connect(alarm, &ClickableLabel::clicked, this, &MainWindow::on_alarm_clicked);
    ui->tableViewPatients->setModel(Etmp.afficher());
    connect(ui->pushButton_Cal, &QPushButton::clicked, this, &MainWindow::openCalculator);
    connect(ui->export_5, &QPushButton::clicked, this, &MainWindow::exportToExcel);
connect(ui->pushButton_16, &QPushButton::clicked, this, &MainWindow::runBarcodeScanner);
    connect(ui->quitter, &QPushButton::clicked, this, &MainWindow::on_quitter_5_clicked);
    connect(ui->tri_2, &QPushButton::clicked, this, &MainWindow::on_tri_2_clicked);
    connect(ui->rechercher_2, &QPushButton::clicked, this, &MainWindow::on_rechercher_2_clicked);
    connect(ui->afficher_3, &QPushButton::clicked, this, &MainWindow::on_afficher_3_clicked);
    connect(ui->supprimer_2, &QPushButton::clicked, this, &MainWindow::on_supprimer_2_clicked);
    connect(ui->modifier_4, &QPushButton::clicked, this, &MainWindow::on_modifier_4_clicked);

}
MainWindow::~MainWindow()
{
    delete ui;
}

void MainWindow::on_bn_clicked(){
    NotifyManager *manager = new NotifyManager(this);

    connect(ui->bn, &QPushButton::clicked, manager, [manager]{
        manager->notify("Hello", "please don't forget to sut down the pc", "c:/User/21692/Desktop/projet c++/logo1.png", "");
    });
}
void MainWindow::on_pushButton_Ajouter_clicked()
{
    QString nom=ui->lineEditNom->text();
    QString prenom=ui->lineEditPrenom->text();
    int num=ui->lineEditTel->text().toInt();
    QDate dateN=ui->dateEditDateN->date();
    QString adress=ui->lineEditAdress->text();
    QString typeRed=ui->lineEditTypeRed->text();

    Patient t(nom,prenom,num,dateN,adress,typeRed);

    bool test=t.ajouter();

    if(test){
        ui->tableViewPatients->setModel(Etmp.afficher());
       // ui->tableView_Stats->setModel(Etmp.afficher_Stats());
        //ui->tableView_typeRed->setModel(Etmp.afficher_Stats_TypeRed());
        QMessageBox::information(nullptr, QObject::tr("Successful"),
                                 QObject::tr("Ajout effectué\n"
                                 "Click Cancel to exit."), QMessageBox::Cancel);

        ui->lineEditNom->clear();
        ui->lineEditPrenom->clear();
        ui->lineEditTel->clear();
        ui->dateEditDateN->clear();
        ui->lineEditAdress->clear();
        ui->lineEditTypeRed->clear();
    }
    else{
        QMessageBox::critical(nullptr, QObject::tr("Declined"),
                             QObject::tr("Ajout non effectue.\n"
                                         "Click Cancel to exit."),QMessageBox::Cancel);
    }
}

void MainWindow::on_pushButton_Supprimer_3_clicked()
{
    QStandardItemModel *model = static_cast<QStandardItemModel *>(ui->tableViewPatients->model());

    if(Etmp.supprimer(model)) {
        ui->tableViewPatients->setModel(Etmp.afficher());
    } else {
        QMessageBox::critical(this, "Error", "Failed to delete patient(s).");
    }
    //ui->tableView_Stats->setModel(Etmp.afficher_Stats());
    //ui->tableView_typeRed->setModel(Etmp.afficher_Stats_TypeRed());
}


void MainWindow::on_pushButton_Modifier_4_clicked()
{
    QAbstractItemModel *model = ui->tableViewPatients->model();

        int checkedCount = 0;

        for (int row = 0; row < model->rowCount(); ++row) {

            QModelIndex index = model->index(row, 7);

            if (model->data(index, Qt::CheckStateRole) == Qt::Checked) {
                checkedCount++;
            }
        }

        if (checkedCount == 1) {
            Modifier d(static_cast<QStandardItemModel*>(model), this);
            d.exec();
        } else {
            QMessageBox::critical(this, "Error", "Please check exactly one row to modify.");
        }
        ui->tableViewPatients->setModel(Etmp.afficher());
        //ui->tableView_Stats->setModel(Etmp.afficher_Stats());
        //ui->tableView_typeRed->setModel(Etmp.afficher_Stats_TypeRed());
    }

void MainWindow::on_comboBox_Sort_currentIndexChanged()
{
    QString sortOption = ui->comboBox_Sort->currentText();

    if (sortOption == "Alphabet ↑") {
        // Sort patients by name in ascending order
        ui->tableViewPatients->sortByColumn(1, Qt::AscendingOrder);
    } else if (sortOption == "Alphabet ↓") {
        // Sort patients by name in descending order
        ui->tableViewPatients->sortByColumn(1, Qt::DescendingOrder);
    } else if (sortOption == "Date ↑") {
        // Sort patients by date of birth in ascending order
        ui->tableViewPatients->sortByColumn(4, Qt::AscendingOrder);
    } else if (sortOption == "Date ↓") {
        // Sort patients by date of birth in descending order
        ui->tableViewPatients->sortByColumn(4, Qt::DescendingOrder);
    }
    else if (sortOption == "ID ↑"){
        ui->tableViewPatients->sortByColumn(0, Qt::AscendingOrder);
    }
    else if (sortOption == "ID ↓"){
        ui->tableViewPatients->sortByColumn(0, Qt::DescendingOrder);
    }
    else{
        ui->tableViewPatients->setModel(Etmp.afficher());
    }
}

/*void MainWindow::on_comboBox_Stats_currentIndexChanged()
{
    QString sortOption = ui->comboBox_Stats->currentText();

    // Sort the patients based on the selected option
    if (sortOption == "Alphabet ↓") {
        // Sort patients by name in ascending order
        ui->tableView_Stats->sortByColumn(1, Qt::AscendingOrder);
    } else if (sortOption == "Alphabet ↑") {
        // Sort patients by name in descending order
        ui->tableView_Stats->sortByColumn(1, Qt::DescendingOrder);
    } else if (sortOption == "Date ↓") {
        // Sort patients by date of birth in ascending order
        ui->tableView_Stats->sortByColumn(4, Qt::AscendingOrder);
    } else if (sortOption == "Date ↑") {
        // Sort patients by date of birth in descending order
        ui->tableView_Stats->sortByColumn(4, Qt::DescendingOrder);
    }
    else if (sortOption == "ID ↑"){
        ui->tableView_Stats->sortByColumn(0, Qt::AscendingOrder);
    }
    else if (sortOption == "ID ↓"){
        ui->tableView_Stats->sortByColumn(0, Qt::DescendingOrder);
    }
    else{
        ui->tableView_Stats->setModel(Etmp.afficher_Stats());
    }
}*/

void MainWindow::on_lineEdit_Search_textChanged(const QString &searchText)
{
    QAbstractItemModel *model = Etmp.afficher();

        QSortFilterProxyModel *proxyModel = new QSortFilterProxyModel(this);
        proxyModel->setSourceModel(model);
        proxyModel->setFilterCaseSensitivity(Qt::CaseInsensitive);

        if (searchText.isEmpty()) {
            proxyModel->setFilterRegExp(QRegExp());
        } else {
                    if (isNumeric(searchText)) {
                                QRegExp regex(searchText, Qt::CaseInsensitive, QRegExp::FixedString);
                                proxyModel->setFilterRegExp(regex);
                                proxyModel->setFilterKeyColumn(3); // Phone number column
                            } else {
                                QRegExp regex(searchText, Qt::CaseInsensitive, QRegExp::FixedString);
                                proxyModel->setFilterRegExp(regex);
                                proxyModel->setFilterKeyColumn(1); // Name column
                            }
        }
        ui->tableViewPatients->setModel(proxyModel);
}

bool MainWindow::isNumeric(const QString &searchText){
    bool isNumeric = true;
            for (const QChar &c : searchText) {
                if (!c.isDigit()) {
                    isNumeric = false;
                    break;
                }
            }
     return isNumeric;
}

/*void MainWindow::on_lineEdit_Search_Stats_textChanged(const QString &searchTextStats)
{
    QAbstractItemModel *model = Etmp.afficher_Stats();

        QSortFilterProxyModel *proxyModel = new QSortFilterProxyModel(this);
        proxyModel->setSourceModel(model);
        proxyModel->setFilterCaseSensitivity(Qt::CaseInsensitive);

        if (searchTextStats.isEmpty()) {
            proxyModel->setFilterRegExp(QRegExp());
        } else {
                    if (isNumeric(searchTextStats)) {
                                QRegExp regex(searchTextStats, Qt::CaseInsensitive, QRegExp::FixedString);
                                proxyModel->setFilterRegExp(regex);
                                proxyModel->setFilterKeyColumn(3); // Phone number
                            } else {
                                QRegExp regex(searchTextStats, Qt::CaseInsensitive, QRegExp::FixedString);
                                proxyModel->setFilterRegExp(regex);
                                proxyModel->setFilterKeyColumn(1); // Name
                            }
        }
        ui->tableView_Stats->setModel(proxyModel);
}*/



void MainWindow::on_alarm_clicked()
{
    QMessageBox::StandardButton reply;
    reply = QMessageBox::question(this, "ALERT!", "ARE YOU SURE TOU WANT TO SET THE ALARM ?", QMessageBox::Yes|QMessageBox::No);
    if (reply == QMessageBox::Yes) {
        QTimer::singleShot(20000, this, &MainWindow::close);
        QMediaPlayer *mediaPlayer = new QMediaPlayer(this);
        connect(mediaPlayer, &QMediaPlayer::mediaStatusChanged, this, &MainWindow::handleMediaStatusChanged);
        mediaPlayer->setMedia(QUrl::fromLocalFile(":/new/prefix1/Alarm Sound Effect.mp3"));
        mediaPlayer->play();
        QMessageBox::warning(nullptr, QObject::tr("ALERT:DANGER DETECTED !!!"),
                    QObject::tr("Please evacuate immediately. This is not a drill. Your safety is our top priority. Follow emergency procedures and exit the area calmly but swiftly. Stay tuned for further instructions."));
    }
}

void MainWindow::handleMediaStatusChanged(QMediaPlayer::MediaStatus status)
{
    if (status == QMediaPlayer::EndOfMedia) {
        QMediaPlayer *mediaPlayer = qobject_cast<QMediaPlayer*>(sender());
        if (mediaPlayer) {
            mediaPlayer->setPosition(0);
            mediaPlayer->play();
        }
    }
}

void MainWindow::closeEvent(QCloseEvent *event)
{
    // Clean up resources or perform any necessary tasks before closing the application
    QMainWindow::closeEvent(event);
}

void MainWindow::exportToPdf(const QString &filePath, QTableView *tableView) {
    // Create a QTextDocument to hold the contents of the table
    QTextDocument doc;

    // Iterate over the table and append its contents to the QTextDocument
    QTextCursor cursor(&doc);
    QString tableContents;
    for (int row = 0; row < tableView->model()->rowCount(); ++row) {
        for (int column = 0; column < tableView->model()->columnCount(); ++column) {
            QModelIndex index = tableView->model()->index(row, column);
            QString data = tableView->model()->data(index).toString();
            tableContents.append(data + "\t");
        }
        tableContents.append("\n");
    }
    cursor.insertText(tableContents);

    // Create a QPrinter for PDF output
    QPrinter printer(QPrinter::PrinterResolution);
    printer.setOutputFormat(QPrinter::PdfFormat);
    printer.setOutputFileName(filePath);

    // Print the QTextDocument to the PDF file
    doc.print(&printer);
}

void MainWindow::on_pushButton_Export_clicked() {
    // Get the file path from the user
    QString filePath = QFileDialog::getSaveFileName(this, tr("Save PDF"), "", tr("PDF Files (*.pdf)"));
    if (filePath.isEmpty())
        return; // User canceled or no file selected

    // Export the contents of the table to the PDF file
    exportToPdf(filePath, ui->tableViewPatients);
    QMessageBox::information(this, tr("Export Successful"), tr("PDF exported successfully."));
}


void MainWindow::on_pushButton_AfficherTypeReeducation_clicked()
{
    Etmp.displayChartView();
}

void MainWindow::on_pushButton_AfficherTypeReeducation_2_clicked()
{
    Etmp.displayChartViewTop3Customers();
}

/***************************************************** OTHER ***************************************************/

void MainWindow::on_pushButtonValider_3_clicked()
{
    // Retrieve data from UI elements

       QString nom = ui->lineEditNom_3->text();
       QString prenom = ui->lineEditPrenom_3->text();
       QString cin = ui->lineEditCin_3->text();
       int Num = ui->lineEditNum_3->text().toInt();
       QString DateN = ui->dateEdit_3->text();
       QString fonction = ui->comboBox_3->currentText();
       QString salaire = ui->lineEdit_4->text();

       // Create Employe object with the retrieved data
       Employe e( nom, prenom,DateN,fonction,cin,Num,salaire);

       // Add the employee to the database
       bool test = e.ajouter();

       QMessageBox msgBox;

       if (test)
          {
           QMessageBox::information(nullptr, QObject::tr("ok"),QObject::tr("ajout effectué"),QMessageBox::Cancel);
            ui->lineEditNom_3->clear();
            ui->lineEditPrenom_3->clear();
           ui->lineEditCin_3->clear();
            ui->lineEditNum_3->clear();
           ui->dateEdit_3->clear();
           ui->comboBox_3->clear();
           ui->lineEdit_4->clear();
            ui->tableView_4->setModel(e.afficher());
          }
          else
          {
               QMessageBox::critical(nullptr, QObject::tr("not ok"),QObject::tr("ajout non effectué"),QMessageBox::Cancel);
          }

       msgBox.exec();
   }


void MainWindow::on_pushButton_13_clicked()
{
     Employe e;// Use the correct instance name 'e' instead of 'm'
        int id = ui->lineEditNom_11->text().toInt();
        QMessageBox msgbox;
        msgbox.setWindowTitle("supprimer");
        msgbox.setText("voulez-vous supprimer cet employé");
        msgbox.setStandardButtons(QMessageBox::Yes);
        msgbox.addButton(QMessageBox::No);

        if (msgbox.exec() == QMessageBox::Yes)
        {
            bool test = e.supprimer(id); // Use the correct instance name 'e' instead of 'emp'

            if (test)
            {
                ui->tableView_4->setModel(e.afficher());

                QMessageBox::information(nullptr, QObject::tr("supprimer un client"),
                                         QObject::tr("client supprimé.\n"
                                                     "click ok to exit"), QMessageBox::Ok);
            }
            else
            {
                QMessageBox::critical(nullptr, QObject::tr("supprimer un client"),
                                      QObject::tr("Erreur.\n"
                                                  "click cancel to exit"), QMessageBox::Cancel);
            }
        }
        else
        {
            ui->tableView_4->setModel(e.afficher());
        }
    }


void MainWindow::on_pushButtonmodif_clicked()
{
    Employe employe; // Utilisez le bon nom de classe si différent

        // Retrieve data from UI
        int idd = ui->lineEditid->text().toInt(); // Utilisez le nom du lineEdit correspondant à l'ID
        QString nouveauNom = ui->lineEditNom_10->text(); // Utilisez le nom du lineEdit correspondant au nom
        QString nouveauPrenom = ui->lineEditPrenom_6->text(); // Utilisez le nom du lineEdit correspondant au prénom
        QString dateN = ui->dateEdit_5->text(); // Utilisez le nom du lineEdit correspondant à la date
        QString nouvCin = ui->lineEditCin_4->text(); // Utilisez le nom du lineEdit correspondant au CIN
        QString nouvFonction = ui->comboBox_6->currentText();; // Utilisez le nom du lineEdit correspondant à la fonction
        int num = ui->lineEditNum_4->text().toInt(); // Utilisez le nom du lineEdit correspondant au numéro
        QString nouvSalaire = ui->lineEdit_5->text(); // Utilisez le nom du lineEdit correspondant au salaire

        // Check if any of the data fields are non-empty or non-zero
        if (idd == 0 && nouveauNom.isEmpty() && nouveauPrenom.isEmpty() && dateN.isEmpty() && nouvCin.isEmpty() && nouvFonction.isEmpty() && num == 0 && nouvSalaire.isEmpty()) {
            QMessageBox::information(nullptr, QObject::tr("No Data Entered"),
                                     QObject::tr("Please enter data before attempting to modify."), QMessageBox::Ok);
            return;  // Stop further execution if no data is entered
        }

        // Attempt to modify the data in the database
        bool test = employe.modifier(nouveauNom, nouveauPrenom, idd, dateN, nouvCin, nouvFonction, num, nouvSalaire);

        if (test) {
            // Update the table view with the modified data
            ui->tableView_4->setModel(employe.afficher());

            // Clear input fields
            ui->lineEditid->clear();
            ui->lineEditNom_10->clear();
            ui->lineEditPrenom_6->clear();
            ui->dateEdit_5->clear();
            ui->lineEditCin_4->clear();
            ui->comboBox_6->clear();
            ui->lineEditNum_4->clear();
            ui->lineEdit_5->clear();

            // Inform the user about the successful modification
            QMessageBox::information(nullptr, QObject::tr("Modifier un client"),
                                     QObject::tr("Client modifié.\nClick OK to return."), QMessageBox::Ok);
        } else {
            // Inform the user about the error in modification
            QMessageBox::critical(nullptr, QObject::tr("Modifier un client"),
                                  QObject::tr("Erreur.\nClick Cancel to exit."), QMessageBox::Cancel);
        }
}

void MainWindow::on_pushButton_10_clicked()
{
    QString cinn = ui->lineEdit_6->text();

       // Vérifier si le CIN est non vide
       if (!cinn.isEmpty()) {
           // Créer un objet Employe pour utiliser la fonction de recherche
           Employe employe;

           // Appeler la fonction de recherche
           QSqlQueryModel* model = employe.rechercherParCin(cinn);

           // Mettre à jour la vue avec les résultats de la recherche
           ui->tableView_4->setModel(model);
       } else {
           // Afficher un message si aucun CIN n'est saisi
           QMessageBox::warning(this, "Attention", "Veuillez saisir le CIN pour effectuer la recherche.");
       }
}

void MainWindow::on_pushButton_9_clicked()
{
    Employe employe;

       // Appeler la fonction de tri
       QSqlQueryModel* model = employe.trierNomsAZ();

       // Mettre à jour la vue avec les résultats triés
       ui->tableView_4->setModel(model);
}

void MainWindow::on_pushButton_11_clicked()
{
    // Créer un modèle pour contenir les résultats de la requête SQL
       displayCharts_CLIENT();
      Employe employe;
      QSqlQueryModel* model = employe.calculerStatistiquesSalaireMoyenParFonction();


         ui->tableViewStatistiques->setModel(model);
}
void MainWindow::displayCharts_CLIENT()

    {
    QMap<QString, double> averageSalaryByFunction;

       QSqlQuery query;
       query.prepare("SELECT FONCTION, AVG(SALAIRE) FROM EMPLOYE GROUP BY FONCTION");
       if (query.exec()) {
           while (query.next()) {
               QString function = query.value(0).toString();
               double averageSalary = query.value(1).toDouble();
               averageSalaryByFunction[function] = averageSalary;
           }
       } else {
           qDebug() << "Error in SQL query: " << query.lastError().text();
           return;
       }

       double totalSalary = 0;
       for (double salary : averageSalaryByFunction.values()) {
           totalSalary += salary;
       }

       QGraphicsScene* scene = new QGraphicsScene(this);
       QGraphicsView* view = new QGraphicsView(scene);
       view->setRenderHint(QPainter::Antialiasing);

       qreal chartSize = 200;
       qreal centerX = chartSize / 2;
       qreal centerY = chartSize / 2;

       qreal startAngle = 0;
       for (const QString& function : averageSalaryByFunction.keys()) {
           qreal angle = 360.0 * averageSalaryByFunction[function] / totalSalary;
           QColor sliceColor = QColor(qrand() % 256, qrand() % 256, qrand() % 256); // Random color

           QGraphicsEllipseItem* slice = scene->addEllipse(centerX - chartSize / 2, centerY - chartSize / 2, chartSize, chartSize, QPen(Qt::black), QBrush(sliceColor));
           slice->setStartAngle(startAngle * 16);
           slice->setSpanAngle(angle * 16);

           qreal percentage = 100.0 * averageSalaryByFunction[function] / totalSalary;
           QString percentageText = QString::number(percentage, 'f', 1) + "%";
           QGraphicsTextItem* label = scene->addText(percentageText, QFont("Arial", 10, QFont::Bold));
           label->setPos(centerX + 0.7 * chartSize * qCos(qDegreesToRadians(startAngle + angle / 2)),
               centerY + 0.7 * chartSize * qSin(qDegreesToRadians(startAngle + angle / 2)));

           startAngle += angle;
       }

       view->setRenderHint(QPainter::Antialiasing);
       view->setRenderHint(QPainter::TextAntialiasing);
       view->show();
   }




void MainWindow::on_exportPDFButton_clicked()
{

    QString fileName = QFileDialog::getSaveFileName(this, "Enregistrer sous", "", "PDF (*.pdf)");
       if (fileName.isEmpty()) {
           // Si aucun nom de fichier n'est sélectionné, annuler l'exportation
           return;
       }

       // Créer une imprimante pour le PDF
       QPrinter printer(QPrinter::PrinterResolution);
       printer.setOutputFormat(QPrinter::PdfFormat);
       printer.setPaperSize(QPrinter::A4);
       printer.setOutputFileName(fileName);

       // Créer un peintre pour dessiner sur l'imprimante
       QPainter painter(&printer);

       // Récupérer le modèle de la vue
       QAbstractItemModel *model = ui->tableView_4->model();
       if (!model) {
           QMessageBox::warning(this, "Erreur", "Aucun modèle de tableau trouvé.");
           return;
       }

       // Dessiner le contenu du tableau sur le PDF
       int rowCount = model->rowCount();
       int colCount = model->columnCount();
       int cellHeight = 20; // Hauteur de chaque cellule
       int cellWidth = 100; // Largeur de chaque cellule
       int x = 0;
       int y = 0;

       // Dessiner l'en-tête
       for (int col = 0; col < colCount; ++col) {
           QString header = model->headerData(col, Qt::Horizontal).toString();
           painter.drawText(x, y, cellWidth, cellHeight, Qt::AlignLeft, header);
           x += cellWidth;
       }
       y += cellHeight;

       // Dessiner les données
       for (int row = 0; row < rowCount; ++row) {
           x = 0;
           for (int col = 0; col < colCount; ++col) {
               QModelIndex index = model->index(row, col);
               QString data = model->data(index).toString();
               painter.drawText(x, y, cellWidth, cellHeight, Qt::AlignLeft, data);
               x += cellWidth;
           }
           y += cellHeight;
       }

       // Terminer et enregistrer le PDF
       painter.end();
       QMessageBox::information(this, "Export PDF", "Le tableau a été exporté avec succès en PDF.");
   }

////////////////////////////////////////////////////////////////

void MainWindow::on_afficher_5_clicked()
{Equipement tmpequip;
ui->tableView_3->setModel(tmpequip.afficher());//refresh
}



void MainWindow::on_modifier_2_clicked()
{
    Equipement tmpequip;

    // Retrieve data from UI
    int CODE = ui->id_don_2->text().toInt();
    int ID_FOURNISSEUR = ui->iddonateurr_2->text().toInt();
    int QUANTITE = ui->quantiteedon_2->text().toInt();
    QString TYPE_CAT = ui->quantiteedon_3->text();
    int ARG_UNIT = ui->c4_5->text().toInt();
    int ARG_TOT = ui->c4_2->text().toInt();

    if (CODE == 0 && ID_FOURNISSEUR == 0 && QUANTITE == 0 && TYPE_CAT.isEmpty() && ARG_UNIT == 0 && ARG_TOT == 0) {
        QMessageBox::information(nullptr, QObject::tr("No Data Entered"),
                                 QObject::tr("Please enter data before attempting to modify."), QMessageBox::Ok);
        return;
    }


    bool test = tmpequip.modifier(CODE, ID_FOURNISSEUR, QUANTITE, TYPE_CAT, ARG_UNIT, ARG_TOT);

    if (test) {

        ui->tableView_3->setModel(tmpequip.afficher());


        ui->id_don_2->clear();
        ui->iddonateurr_2->clear();
        ui->quantiteedon_2->clear();
        ui->quantiteedon_3->clear();
        ui->c4_5->clear();
        ui->c4_2->clear();

        QString exec;

        NotifyManager *manager = new NotifyManager(this);
                manager->notify("Success", "Equipement modifié avec succès", "", "");
        logToFile("<b style='font-size: 14px; color: #800080;'>Historique de Modifications :</b><br>", "\n\n<br>\n" +
                              QDateTime::currentDateTime().toString("[ddd MMM dd HH:mm:ss]-") +
                              "  Un equipement a été modifié dans la table equipement avec avec le code: <span style='color: red; font-weight: bold; font-style: italic;'> \n" +
                              QString("<b>") + QString::number(CODE) + QString("</b><br>") +
                              "\n</span>\n"
                              );


    } else {

        QMessageBox::critical(nullptr, QObject::tr("Modifier un client"),
                              QObject::tr("Erreur.\nClick Cancel to exit."), QMessageBox::Cancel);
    }

}



void MainWindow::on_pushB_2_clicked()//supp
{
    Equipement f;
    bool t;
    t=f.reset();
    if(t)
     {    QMessageBox::information(nullptr, QObject::tr("supp avec succes"),
                                   QObject::tr("sup successful.\n"
                                               "Click Cancel to exit."), QMessageBox::Cancel);
            ui->tableView_3->setModel(f.afficher());
               }
                   else
                       QMessageBox::critical(nullptr, QObject::tr("sup errer"),
                                   QObject::tr("sup failed.\n"
                                               "Click Cancel to exit."), QMessageBox::Cancel);
}




void MainWindow::on_pushButton_15_clicked()
{
    QSqlQueryModel *model = new QSqlQueryModel();
    model->setHeaderData(0, Qt::Horizontal, QObject::tr("CODE"));
    model->setHeaderData(1, Qt::Horizontal, QObject::tr("ARG_TOT"));
    model->setHeaderData(2, Qt::Horizontal, QObject::tr("ARG_UNIT"));
    model->setHeaderData(3, Qt::Horizontal, QObject::tr("QUANTITE"));

    ui->tableView_5->setModel(model);

    QSqlQuery query;

    QString orderByClause;

    if (ui->comboBox_7->currentText() == "CODE")
        orderByClause = "ORDER BY CODE ASC";
    else if (ui->comboBox_7->currentText() == "ARG_TOT")
        orderByClause = "ORDER BY ARG_TOT ASC";
    else if (ui->comboBox_7->currentText() == "ARG_UNIT")
        orderByClause = "ORDER BY ARG_UNIT ASC";
    else if (ui->comboBox_7->currentText() == "QUANTITE")
        orderByClause = "ORDER BY QUANTITE ASC";

    query.prepare("SELECT * FROM Equipement " + orderByClause);

    if (query.exec() && query.next())
    {
        model->setQuery(query);
        ui->tableView_5->setModel(model);
    }
}




void MainWindow::on_pushButton_8_clicked()
{

    Equipement P(1,1,1,"",1,1);
      // e.cleartable(ui->tableView_aff);
       QString cas =ui->lineEdit_r->text();
       P.rechercher(ui->tableView_aff,cas);

       if(ui->lineEdit_r->text().isEmpty())
       {
           ui->tableView_aff->setModel(P.afficher());
       }

}
void MainWindow::on_ajouter_2_clicked()
{
    Equipement tmpequip;
    int CODE = ui->lineedit_code->text().toInt();
    int ID_FOURNISSEUR = ui->iddonateurr->text().toInt();
    int QUANTITE = ui->quantiteedon->text().toInt();
    QString TYPE_CAT = ui->aa->text();
    int ARG_UNIT = ui->c4_4->text().toInt();
    int ARG_TOT = ui->c4->text().toInt();
    Equipement e(CODE, ID_FOURNISSEUR, QUANTITE, TYPE_CAT, ARG_UNIT, ARG_TOT);
    bool test=e.ajouter();
    if (test)
    {
        ui->tableView_3->setModel(tmpequip.afficher());
        ui->lineedit_code->clear();
        ui->iddonateurr->clear();
        ui->quantiteedon->clear();
        ui->aa->clear();
        ui->c4_4->clear();
        ui->c4->clear();
        NotifyManager *manager = new NotifyManager(this);
                manager->notify("Success", "Equipement ajouté avec succès", "", "");

                logToFile("<b style='font-size: 14px; color: #00008B;'>Historique d'ajout :</b><br>", "<br>" +
                              QDateTime::currentDateTime().toString("[ ddd MMM dd HH:mm:ss ]- ") +
                              "  Un nouveau Equipement a été ajouté dans la table Equipement avec le code:  <span style='color: red; font-weight: bold; font-style: italic;'> \n" +
                          QString("<b>") + QString::number(CODE) + QString("</b><br>") +
                               +
                              "\n</span>\n");
    }
    else
    {
        QMessageBox ::critical(nullptr,QObject::tr("ajouter un client"),
                                          QObject::tr("Erreur.\n"
                                              "click cancel to exit"),QMessageBox::Cancel);    }



}
void MainWindow::openCalculator()
{
    // Open the calculator using QProcess
    QProcess::startDetached("calc.exe");
}

void MainWindow::on_supp_clicked()
{
    Equipement tmpequip;
    int CODE =ui->lineEdit_3->text().toInt();
    QMessageBox msgbox;
    msgbox.setWindowTitle("supprimer");
    msgbox.setText("voulez_vous supprimer ce client?");
    msgbox.setStandardButtons(QMessageBox ::Yes);
    msgbox.addButton(QMessageBox::No);
    if(msgbox.exec()==QMessageBox::Yes)

    {
        bool test=tmpequip.supprimer(CODE);

    if(test)
    {
        ui->tableView_3->setModel(tmpequip.afficher());
        ui->lineEdit_3->clear();
        NotifyManager *manager = new NotifyManager(this);
                manager->notify("Success", "Equipement supprimé avec succès", "", "");

    }
    else
    {

        QMessageBox ::critical(nullptr,QObject::tr("supprimer un client"),
                                          QObject::tr("Erreur.\n"
                                              "click cancel to exit"),QMessageBox::Cancel);
    }
    }
    else
        ui->tableView_3->setModel(tmpequip.afficher());
    logToFile("<b style='font-size: 14px; color: #00008B;'>Historique de Suppression :</b><br>", "<br>" +
                  QDateTime::currentDateTime().toString("[ ddd MMM dd HH:mm:ss ]- ") +
                  "  Un nouveau Equipement a été supprimé de la table Equipement avec le code:  <span style='color: red; font-weight: bold; font-style: italic;'> \n" +
              QString("<b>") + QString::number(CODE) + QString("</b><br>") +
                   +
                  "\n</span>\n");
}


#include <QThread>


void MainWindow::exportToExcel()
{
    QString filePath = QFileDialog::getSaveFileName(this, "Export to Excel", QString(), "Excel Files (*.xlsx)");

    if (filePath.isEmpty())
        return;

    QAxObject *excel = new QAxObject("Excel.Application", this);

    if (excel->isNull()) {
        // Handle the case when Excel is not available
        delete excel;
        return;
    }

    QAxObject *workbooks = excel->querySubObject("Workbooks");
    QAxObject *workbook = workbooks->querySubObject("Add()");
    QAxObject *worksheets = workbook->querySubObject("Worksheets(int)", 1);
    QAxObject *worksheet = worksheets->querySubObject("Cells(int, int)", 1, 1);

    Equipement tmpequip; // Assuming Equipement has appropriate data retrieval methods
    QStringList headerData = {"CODE", "ID_FOURNISSEUR", "QUANTITE", "TYPE_CAT", "ARG_UNIT", "ARG_TOT"};

    // Write headers
    int col = 1;
    foreach (const QString &header, headerData)
    {
        worksheet->querySubObject("Cells(int, int)", 1, col++)->setProperty("Value", header);
    }

    // Write data
    int row = 2; // Start from the second row
    QSqlQueryModel *model = tmpequip.afficher(); // Assuming afficher() returns the data
    for (int i = 0; i < model->rowCount(); ++i)
    {
        col = 1; // Reset column index for each row
        for (int j = 0; j < model->columnCount(); ++j)
        {
            QVariant data = model->data(model->index(i, j));
            worksheet->querySubObject("Cells(int, int)", row, col++)->setProperty("Value", data.toString());
        }
        ++row;
    }

    workbook->dynamicCall("SaveAs(const QString&)", filePath);
    workbook->dynamicCall("Close()");
    excel->dynamicCall("Quit()");

    // Introduce a delay before deleting or moving the file
    //QThread::msleep(1000); // 1000 milliseconds (1 second) delay

    delete excel;

    qDebug() << "Debug Information";


    // Now you can delete or move the file without issues
}

void MainWindow::on_quitter_5_clicked()
{
    // Close the main window
    close();
}
void MainWindow::on_quitter_2_clicked()
{
    // Close the main window
    close();
}
void MainWindow::on_quitter_3_clicked()
{
    // Close the main window
    close();
}
#include <QFileDialog>
#include <QPainter>
#include <QPrinter>
#include <QMessageBox>


//Malek
/*void MainWindow::on_pushButton_12_clicked()
{
  Client c ;
  c.setID(ui->lineEditNom_13->text());
   c.setDAT(ui->dateEdit_2->date());
    c.setTEL(ui->lineEditNom_3->text());
     c.setHEURE(ui->timeEdit_2->text());



      // rendez R;
     //  R.setclient(c);
      // R.exec();
}*/
void MainWindow::on_ajouter_4_clicked()
{
    QString ID=ui->lineEditNom_13->text();
    QDate DAT=ui->dateEdit_4->date();
    QString TEL=ui->lineEditNom_14->text();
    QString HEURE=ui->timeEdit_7->text();
    QString EMAIL=ui->ajouter_email->text();

    Client c(ID,DAT,TEL,HEURE,EMAIL);
    bool test=c.Ajouter();
    if(test)
    {
        QMessageBox::information(nullptr, QObject::tr("OK"),
                                 QObject::tr("Ajout effectuer\n"
                                             "Click Cancel to exit."),QMessageBox::Cancel);
        mailer::sendEmail(ID,TEL,DAT,HEURE,EMAIL);
        QFile file("C:/Users/21692/Desktop/projet c++/ajout.txt");
                                      if (file.open(QIODevice::Append | QIODevice::Text)) {
                                          QTextStream stream(&file);
                                          stream << "ID added: " << ID << ", Time: " << QDateTime::currentDateTime().toString() << endl;
                                          file.close();
                                      }

    }

else
        QMessageBox::critical(nullptr,QObject::tr("Not OK"),
                              QObject::tr("Ajout non effectué.\n"
                                          "Click Cancel to exite."), QMessageBox::Cancel);
}
void MainWindow::on_supprimer_2_clicked()
{

    QString ID =ui->lineEditNom_17->text();
    bool test=Etmp1.supprimer(ID);
    if(test)
    {
        QMessageBox::information(nullptr, QObject::tr("OK"),
                                 QObject::tr("Suppression effectuer\n"
                                             "Click Cancel to exit."),QMessageBox::Cancel);
        QFile file("C:/Users/21692/Desktop/projet c++/suppression.txt");
                                      if (file.open(QIODevice::Append | QIODevice::Text)) {
                                          QTextStream stream(&file);
                                          stream << "ID DELETED: " << ID << ", Time: " << QDateTime::currentDateTime().toString() << endl;
                                          file.close();
                                      }
    }

else
        QMessageBox::critical(nullptr,QObject::tr("Not OK"),
                              QObject::tr("Suppression non effectué.\n"
                                          "Click Cancel to exite."), QMessageBox::Cancel);
}
void MainWindow::on_afficher_3_clicked()
{Client tmpClie;
ui->tableView_7->setModel(tmpClie.afficher());//refresh
}
void MainWindow::on_modifier_4_clicked()
{
    QString ID=ui->lineEditNom_15->text();
    QDate DAT=ui->dateEdit_6->date();
    QString TEL=ui->lineEditNom_16->text();
    QString HEURE=ui->timeEdit_8->text();
    QString EMAIL=ui->ajouter_email_2->text();
    Client c(ID,DAT,TEL,HEURE,EMAIL);
    bool test=c.modifier();

        if(test)
        {
            QMessageBox::information(nullptr, QObject::tr("OK"),
                                     QObject::tr("Modifier effectuer\n"
                                                 "Click Cancel to exit."),QMessageBox::Cancel);
            QFile file("C:/Users/21692/Desktop/projet c++/modification.txt");
                                              if (file.open(QIODevice::Append | QIODevice::Text)) {
                                                  QTextStream stream(&file);
                                                  stream << "ID UPDATED: " << ID << ", Time: " << QDateTime::currentDateTime().toString() << endl;
                                                  file.close();
                                              }
        }

    else
            QMessageBox::critical(nullptr,QObject::tr("Not OK"),
                                  QObject::tr("modifier non effectué.\n"
                                              "Click Cancel to exite."), QMessageBox::Cancel);
}
void MainWindow::on_reset_2_clicked()
{
    Client cl;
    // Appeler la méthode reset() pour supprimer les données de la base de données
    bool success = cl.reset();

    if (success) {
        // Si la réinitialisation a réussi, mettre à jour le modèle du tableView_7
        // Vous devrez remplacer QSqlQueryModel avec le type de modèle que vous utilisez réellement.
        QSqlQueryModel *model = new QSqlQueryModel();
        model->setQuery("SELECT * FROM Client");
        ui->tableView_7->setModel(model);
    } else {
        // Gérer le cas où la réinitialisation a échoué
        qDebug() << "La réinitialisation a échoué.";
    }
}

void MainWindow::on_tri_2_clicked()
{
    Client cl;
    // Appeler la méthode trierParIdent() de l'objet client
    QSqlQueryModel* sortedModel = cl.trierParIdent();

    // Assurez-vous que sortedModel est valide
    if (sortedModel) {
        // Mettre à jour le modèle de votre tableView avec le modèle trié
        ui->tableView_7->setModel(sortedModel);
    } else {
        // Gérer le cas où le tri a échoué
        qDebug() << "Le tri a échoué.";
    }
}

#include <QtSql>

void MainWindow::on_rechercher_2_clicked()
{
    // Récupérer l'identifiant à rechercher depuis l'interface utilisateur
    QString ID = ui->cherche_2->text(); // Utilisez le nom d'objet "cherche" pour récupérer le texte entré par l'utilisateur

    // Vérifier si l'identifiant n'est pas vide
    if (!ID.isEmpty()) {
        // Connexion à la base de données
        QSqlDatabase db = QSqlDatabase::database(); // Assurez-vous que vous avez une connexion valide à votre base de données

        if (db.isValid() && db.isOpen()) {
            QSqlQuery query;

            // Exécutez une requête SQL pour rechercher le client par identifiant
            query.prepare("SELECT * FROM Client WHERE ID = :ID");
            query.bindValue(":ID", ID);

            if (query.exec()) {
                if (query.next()) {
                    // LE CLIENT a été trouvé, remplissez l'objet client avec les données de la base de données
                    QString clientID = query.value("ID").toString();
                    QString clientTEL = query.value("TEL").toString();
                    QString clientHEURE = query.value("HEURE").toString();
                    QDate clientDAT = query.value("D").toDate();

                    // Afficher les détails du client
                    QString message = "ID: " + clientID + "\n";
                    message += "Téléphone: " + clientTEL + "\n";
                    message += "Heure: " + clientHEURE + "\n";
                    message += "Date: " + clientDAT.toString();

                    QMessageBox::information(this, "Client trouvé", message);
                } else {
                    // Le client n'a pas été trouvé, afficher un message d'erreur
                    QMessageBox::warning(this, "Client non trouvé", "Le client avec cet identifiant n'existe pas.");
                }
            } else {
                // Afficher l'erreur SQL
                qDebug() << "Erreur SQL : " << query.lastError().text();
            }
        } else {
            // Connexion à la base de données invalide ou fermée
            qDebug() << "Connexion à la base de données invalide ou fermée.";
        }
    } else {
        // L'identifiant est vide, afficher un message demandant à l'utilisateur de saisir un identifiant
        QMessageBox::warning(this, "Identifiant manquant", "Veuillez entrer un identifiant.");
    }
}
void MainWindow::on_PDF_2_clicked() {
    QString fileName = QFileDialog::getSaveFileName(this, "Enregistrer le PDF", QString(), "Fichiers PDF (*.pdf)");

    if (fileName.isEmpty()) {
        return;  // L'utilisateur a annulé la sélection du fichier
    }

    // Créez le périphérique d'impression
    QPrinter printer(QPrinter::HighResolution);

    // Définissez le nom du fichier de sortie
    printer.setOutputFileName(fileName);
    printer.setOutputFormat(QPrinter::PdfFormat);

    // Créez un document QText pour contenir le contenu du PDF
    QTextDocument doc;

    // Créez un curseur pour ajouter du texte au document
    QTextCursor cursor(&doc);

    // Ajoutez un en-tête au document
    QTextCharFormat format;
    format.setFont(QFont("Arial", 16, QFont::Bold));
    cursor.insertText("Liste des Client \n\n", format);

    // Obtenez le modèle de la table et parcourez les lignes pour ajouter les données au document
    QAbstractItemModel *model = ui->tableView_7->model(); // Modification ici pour récupérer le modèle directement

    int rowCount = model->rowCount();
    int colCount = model->columnCount();

    // Créez une table pour afficher les données
    QTextTable *table = cursor.insertTable(rowCount + 1, colCount);

    // Remplissez la première ligne avec les noms de colonnes
    for (int col = 0; col < colCount; ++col) {
        table->cellAt(0, col).firstCursorPosition().insertText(model->headerData(col, Qt::Horizontal).toString());
    }

    // Remplissez le reste de la table avec les données de la base de données
    for (int row = 0; row < rowCount; ++row) {
        for (int col = 0; col < colCount; ++col) {
            table->cellAt(row + 1, col).firstCursorPosition().insertText(model->data(model->index(row, col)).toString());
        }
    }

    // Imprimez le document sur le périphérique d'impression
    doc.print(&printer);
    QMessageBox::information(this, "Export PDF", "Exportation en PDF réussie !");
}

void MainWindow::on_pushButton_stats_clicked()
{
      // Créer un modèle pour contenir les résultats de la requête SQL
         displayCharts_CLIENT();
        Employe employe;
        QSqlQueryModel* model = employe.calculerStatistiquesSalaireMoyenParFonction();


           ui->tableViewStatistiques->setModel(model);

}
void MainWindow::runBarcodeScanner() {
    QProcess process;
    QString barcodeScriptPath = "C:/Users/21692/Desktop/projet c++/code_barre.py";
    process.start("python", QStringList() << barcodeScriptPath);
    if (!process.waitForStarted()) {
        qDebug() << "Erreur au démarrage du processus :" << process.errorString();
        return;
    }
    if (!process.waitForFinished()) {
        qDebug() << "Erreur à la fin du processus :" << process.errorString();
        return;
    }

    QString output = QString::fromUtf8(process.readAllStandardOutput());
    QString errors = QString::fromUtf8(process.readAllStandardError());

    // Log errors, if any
    if (!errors.isEmpty()) {
        qDebug() << "Erreur lors de l'exécution du script Python :" << errors;
    }
}
void MainWindow::on_calendarWidget_clicked(const QDate &date)
{
    // Retrieve appointments for the selected date
    QString selectedDate = date.toString("yyyy-MM-dd");
    Client client;

    // Assuming you have a method in your Client class to fetch appointments based on date
    // Let's use afficher() method to fetch all appointments and then filter them based on the selected date
    QSqlQueryModel *model = client.afficher();
    QString appointments;
    for (int i = 0; i < model->rowCount(); ++i) {
        QModelIndex index = model->index(i, 1); // Assuming DAT is at index 1
        if (index.isValid()) {
            QDate appointmentDate = index.data().toDate();
            if (appointmentDate == date) {
                appointments += "ID: " + model->data(model->index(i, 0)).toString() + "\n"; // Assuming ID is at index 0
                appointments += "HEURE: " + model->data(model->index(i, 2)).toString() + "\n"; // Assuming DAT is at index 2
                appointments += "TEL: " + model->data(model->index(i, 3)).toString() + "\n"; // Assuming HEURE is at index 3

                appointments += " "  "\n";
                // Add more fields as needed
            }
        }
    }

    // Display the appointments in a message box
    if (!appointments.isEmpty()) {
        QMessageBox::information(this, tr("Appointments for ") + selectedDate, appointments);
    } else {
        QMessageBox::information(this, tr("No Appointments"), tr("There are no appointments for ") + selectedDate);
    }
}

void MainWindow::on_pushButton_historique_clicked()
{
    Equipement p;
    p.afficherHistorique();
}

void MainWindow::logToFile(const QString &type, const QString &message) {
    // Create/Open the history file
    QFile file("C:/Users/21692/Desktop/projet c++/Historique.txt");
    if (!file.open(QIODevice::Append | QIODevice::Text)) {
        qDebug() << "Failed to open history file for writing.";
        return;
    }

    // Write the log message with timestamp
    QString logEntry =  message + "\n";

    // Write the log message
    QTextStream out(&file);

    // Store messages by type
    static QMap<QString, QStringList> messagesByType;

    // Add message to the list of messages for this type
    messagesByType[type].append(logEntry);

    // Close the file
    file.close();

    // Reopen the file to rewrite all messages with the new ones
    if (!file.open(QIODevice::WriteOnly | QIODevice::Text)) {
        qDebug() << "Failed to open history file for writing.";
        return;
    }

    // Write messages to file, separating each type with dashes
    for (auto it = messagesByType.constBegin(); it != messagesByType.constEnd(); ++it) {
        out << "----------------------***-----------------------<br>" << endl;
        out << "\n" << it.key() << " " << endl;
        for (const QString& msg : it.value()) {
            out << msg;

        }
    }
}
//QRCODE g_employe
void MainWindow::on_qrcode_clicked()
{
   Employe e;
    QString text = ui->le_qrR->text() +("/")+  ui->lineEditNom_66->text()+("/")+
    ui->lineEditPrenom_7->text()+("/")+
     ui->lineEditCin_5->text()+("/")+
     ui->lineEditNum_5->text().toInt()+("/")+
     ui->dateEdit_7->text()+("/")+
     ui->comboBox_8->currentText()+("/")+
     ui->lineEdit_13->text();

       // Appelez votre fonction genererqr pour générer le code QR
       e.genererqr(text);
 QMessageBox::information(this, "Code QR généré", "Le code QR a été généré avec succès.");
}
void MainWindow::on_qrcode_equip_clicked()
{
   Equipement e;
   QString text = ui->le_qrR->text() + ("/") + ui->lineEditNom_66->text() + ("/");

   // Check if the conversion is successful before concatenating
   bool conversionSuccess1, conversionSuccess2;
   int codeValue =  ui->lineedit_code->text().toInt(&conversionSuccess1);
   int donateurValue = ui->iddonateurr->text().toInt(&conversionSuccess2);

   if (conversionSuccess1 && conversionSuccess2) {
       text += QString::number(codeValue) + ("/") + QString::number(donateurValue) + ("/");
   } else {
       // Handle the case where the conversion fails
       QMessageBox::warning(this, "Conversion Error", "Unable to convert input to integers.");
       return; // Return from the function early to avoid further issues
   }

   text += ui->quantiteedon->text() + ("/") +
           ui->aa->text() + ("/") +
           QString::number(ui->c4_4->text().toInt()) + ("/") +
           QString::number(ui->c4->text().toInt());

   // Rest of your code remains the same
   e.genererqr(text);
   NotifyManager *manager = new NotifyManager(this);
           manager->notify("Code QR généré", "Le code QR a été généré avec succès.", "", "");


}
void MainWindow::on_afficher_historique_currentIndexChanged(int index)
{
QString selectedOption=ui->afficher_historique->itemText(index);
    QString filePath;
QString modelHeader;
    if (selectedOption == "Ajout") {
        filePath = "C:/Users/21692/Desktop/projet c++/ajout.txt";
        modelHeader = "AJOUT";
    } else if (selectedOption == "Modification") {
        filePath = "C:/Users/21692/Desktop/projet c++/modification.txt";
        modelHeader = "MODIFICATION";
    } else if (selectedOption == "suppression") {
        filePath = "C:/Users/21692/Desktop/projet c++/suppression.txt";
        modelHeader = "SUPPRESSION";
    }

    QFile file(filePath);
    if (file.open(QIODevice::ReadOnly | QIODevice::Text)) {
        QTextStream stream(&file);
        QString fileContent = stream.readAll();
        file.close();

        if (fileContent.isEmpty()) {
            QMessageBox::information(this, "Empty", "The file is empty.");
        } else {
            QStringList rows = fileContent.split("\n");
            QStandardItemModel *model = new QStandardItemModel(this);
            model->setColumnCount(1);

            for (const QString &row : rows) {
                QStandardItem *item = new QStandardItem(row);
                model->appendRow(item);
            }

            model->setHeaderData(0, Qt::Horizontal, QObject::tr(modelHeader.toUtf8().constData()));

            ui->table_historique->setModel(model);
            ui->table_historique->horizontalHeader()->setSectionResizeMode(QHeaderView::ResizeToContents);
            ui->table_historique->verticalHeader()->setSectionResizeMode(QHeaderView::ResizeToContents);
        }
    } else {
        QMessageBox::warning(this, "Error", "Failed to open the file.");
    }
}
#include "reclamation.h"
void MainWindow::on_pushButton_Ajouter_4_clicked()
{
    reclamation tmpequip;
    int id_rec = ui->lineEditNom_9->text().toInt();
    int id_patient = ui->lineEditTel_2->text().toInt();
    QString sujet = ui->lineEditPrenom_5->text();
    reclamation e(id_rec, sujet, id_patient);
    bool test=e.ajouter();
    if (test)
    {
        ui->tableView->setModel(tmpequip.afficher());
        ui->lineEditNom_9->clear();
        ui->lineEditTel_2->clear();
        ui->lineEditPrenom_5->clear();
        NotifyManager *manager = new NotifyManager(this);
                manager->notify("Success", "reclamation envoyé avec succès", "", "");

    }
    else
    {
        QMessageBox ::critical(nullptr,QObject::tr("ajouter une reclamation"),
                                          QObject::tr("Erreur.\n"
                                              "click cancel to exit"),QMessageBox::Cancel);    }



}
void MainWindow::on_affrec_clicked()
{reclamation tmpequip;
ui->tableView->setModel(tmpequip.afficher());//refresh
}

void MainWindow::on_affrec_2_clicked()
{
    reclamation tmpequip;
    int id_rec =ui->lineEdit_2->text().toInt();
    QMessageBox msgbox;
    msgbox.setWindowTitle("supprimer");
    msgbox.setText("voulez_vous supprimer ce client?");
    msgbox.setStandardButtons(QMessageBox ::Yes);
    msgbox.addButton(QMessageBox::No);
    if(msgbox.exec()==QMessageBox::Yes)

    {
        bool test=tmpequip.supprimer(id_rec);

    if(test)
    {
        ui->tableView->setModel(tmpequip.afficher());
        ui->lineEdit_2->clear();
        NotifyManager *manager = new NotifyManager(this);
                manager->notify("Success", "Equipement supprimé avec succès", "", "");

    }
    else
    {

        QMessageBox ::critical(nullptr,QObject::tr("supprimer un client"),
                                          QObject::tr("Erreur.\n"
                                              "click cancel to exit"),QMessageBox::Cancel);
    }
    }
}
void MainWindow::on_pushButton_Modifier_3_clicked()
{
    reclamation a;

    // Retrieve data from UI
    int id_rec = ui->lineEditNom_12->text().toInt();
    QString sujet = ui->lineEditPrenom_8->text();
    int id_patient = ui->lineEditTel_3->text().toInt();


    if (id_rec == 0 && sujet.isEmpty() && id_patient == 0 ) {
        QMessageBox::information(nullptr, QObject::tr("No Data Entered"),
                                 QObject::tr("Please enter data before attempting to modify."), QMessageBox::Ok);
        return;
    }


    bool test = a.modifier(id_rec, sujet, id_patient);

    if (test) {

        ui->tableView->setModel(a.afficher());


        ui->lineEditNom_12->clear();
        ui->lineEditTel_3->clear();
        ui->lineEditPrenom_8->clear();
        QString exec;

        NotifyManager *manager = new NotifyManager(this);
                manager->notify("Success", "Equipement modifié avec succès", "", "");



    } else {

        QMessageBox::critical(nullptr, QObject::tr("Modifier un client"),
                              QObject::tr("Erreur.\nClick Cancel to exit."), QMessageBox::Cancel);
    }

}
void MainWindow::on_affrec_3_clicked()
{

    reclamation P(1,"",1);
      // e.cleartable(ui->tableView_aff);
       QString cas =ui->lineEdit_8->text();
       P.rechercher(ui->tableView_70,cas);

       if(ui->lineEdit_8->text().isEmpty())
       {
           ui->tableView_70->setModel(P.afficher());
       }

}
