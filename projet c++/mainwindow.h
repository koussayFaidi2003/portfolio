#ifndef MAINWINDOW_H
#define MAINWINDOW_H
#include <QtSql>
#include "arduino.h"
#include <QMainWindow>
#include "patient.h"
#include "client.h"
#include "employe.h"
#include"client.h"
#include "modifier.h"
#include "clickablelable.h"
#include <QSortFilterProxyModel>
#include <QtCore>
#include <QtCharts>
#include <QtWidgets>
#include <QtGui>
#include <QMediaPlayer>
#include <QCloseEvent>
#include <QTableView>
#include <QFileDialog>
#include <QTextDocument>
#include <QPrinter>
#include <QtCharts/QChartView>
#include <QtCharts/QPieSeries>
#include <QtCharts/QPieSlice>
#include <QtCore/QDebug>


QT_CHARTS_USE_NAMESPACE

QT_BEGIN_NAMESPACE
namespace Ui { class MainWindow; }
QT_END_NAMESPACE

class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    MainWindow(QWidget *parent = nullptr);
    bool isNumeric(const QString &searchText);
    void logToFile(const QString &type,const QString &message);
    ~MainWindow();

private slots:
    void on_pushButton_historique_clicked();
        void on_calendarWidget_clicked(const QDate &date);

    void displayCharts_CLIENT();
    void on_pushButton_stats_clicked();
    void on_pushButton_Ajouter_clicked();
    void runBarcodeScanner();
void on_exportPDFButton_clicked();
void on_pushButton_Ajouter_4_clicked();
void on_affrec_clicked();
void on_affrec_2_clicked();
void on_pushButton_Modifier_3_clicked();
void on_affrec_3_clicked();
    void on_pushButton_Supprimer_3_clicked();

    void on_pushButton_Modifier_4_clicked();

    void on_comboBox_Sort_currentIndexChanged();

    //void on_comboBox_Stats_currentIndexChanged();
void on_afficher_historique_currentIndexChanged(int index);
    void on_lineEdit_Search_textChanged(const QString &searchText);

    void on_alarm_clicked();



    void handleMediaStatusChanged(QMediaPlayer::MediaStatus status);

    void closeEvent(QCloseEvent *event);

    void exportToPdf(const QString &filePath, QTableView *tableView);

    void on_pushButton_Export_clicked();

    //void on_lineEdit_Search_Stats_textChanged(const QString &arg1);

    void on_pushButton_AfficherTypeReeducation_clicked();

    void on_pushButton_AfficherTypeReeducation_2_clicked();

    /*************************************************** OTHER **************************************************/

    void on_pushButtonValider_3_clicked();

    void on_pushButton_13_clicked();

    void on_pushButtonmodif_clicked();

    void on_pushButton_10_clicked();

    void on_pushButton_9_clicked();

    void on_pushButton_11_clicked();


    void openCalculator();

    void exportToExcel();

    void on_quitter_2_clicked();

    void on_bn_clicked();

    void on_quitter_3_clicked();

    void on_quitter_5_clicked();

    void on_ajouter_2_clicked();

    void on_supp_clicked();

    void on_afficher_5_clicked();

    void on_modifier_2_clicked();

    void on_pushButton_8_clicked();

    void on_pushB_2_clicked();

    void on_pushButton_15_clicked();

    void on_modifier_4_clicked();

    void on_reset_2_clicked();

    void on_afficher_3_clicked();

    void on_supprimer_2_clicked();

    //void on_pushButton_12_clicked();

    void on_ajouter_4_clicked();

    void on_tri_2_clicked();

    void on_rechercher_2_clicked();

    void on_PDF_2_clicked();
void on_qrcode_clicked();
void on_qrcode_equip_clicked();
//void update_label();
private:
    Ui::MainWindow *ui;
    //QSortFilterProxyModel *proxyModel;
    Patient Etmp;
    Client Etmp1;
    ClickableLabel *alarm;
    QMediaPlayer mediaPlayer;
    /*QByteArray data;
    arduino a;*/
};
#endif // MAINWINDOW_H
