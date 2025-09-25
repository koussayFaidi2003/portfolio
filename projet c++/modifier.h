#ifndef MODIFIER_H
#define MODIFIER_H

#include <QDialog>
#include "patient.h"
#include <QMessageBox>
namespace Ui {
class Modifier;
}

class Modifier : public QDialog {
    Q_OBJECT

public:
    explicit Modifier(QStandardItemModel *model, QWidget *parent = nullptr);
    ~Modifier();
    void setPatient(Patient &s); // Change to pass by reference

private slots:
    void on_pushButton_Ajouter_Mod_clicked();

private:
    Ui::Modifier *ui;
    QStandardItemModel *model;
    Patient Etmp;
};


#endif // MODIFIER_H
