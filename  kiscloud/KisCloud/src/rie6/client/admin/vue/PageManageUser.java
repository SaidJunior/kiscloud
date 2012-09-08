package rie6.client.admin.vue;

import java.util.List;

import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.controleur.ListenerAdmin;
import rie6.client.admin.model.User;

import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.DockPanel;
import com.google.gwt.user.client.ui.FlexTable;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.VerticalPanel;

public class PageManageUser extends VerticalPanel {

    private final ControllerAdmin controllerAdmin;

    public PageManageUser(ControllerAdmin controllerAdmin) {

        this.controllerAdmin = controllerAdmin;
        this.setStyleName("pageManageUser");

        this.controllerAdmin.setPageManageListUser(this);

        HorizontalPanel panelMenuManageUser = new HorizontalPanel();
        panelMenuManageUser.setStyleName("panelMenuManageUser");

        Button buttonAddUser = new Button("Add User");
        buttonAddUser.setStyleName("buttonManageUser");
        buttonAddUser.addClickHandler(new ListenerAdmin("buttonAddUser", controllerAdmin));

        Button buttonModifyUser = new Button("Modify");
        buttonModifyUser.setStyleName("buttonManageUser");
        buttonModifyUser.addClickHandler(new ListenerAdmin("buttonModifyUser", controllerAdmin));

        Button buttonDeleteUser = new Button("Delete");
        buttonDeleteUser.setStyleName("buttonManageUser");
        buttonDeleteUser.addClickHandler(new ListenerAdmin("buttonDeleteUser", controllerAdmin));

        panelMenuManageUser.add(buttonAddUser);
        panelMenuManageUser.add(buttonModifyUser);
        panelMenuManageUser.add(buttonDeleteUser);

        controllerAdmin.getListUser();

        // Met la page "PageManageUser" sur le DockePanel principal
        controllerAdmin.getAdminPortal().add(this, DockPanel.CENTER);
    }

    public void setListUser(List<User> result) {

        System.out.println("J'ajoute ma grid pour la DataBase (PanelManageUser)");

        FlexTable tableDataBaseUser = new FlexTable();
        tableDataBaseUser.setStyleName("gridDataBase");
        tableDataBaseUser.setBorderWidth(2);

        HorizontalPanel panelButtonControlDataBase = new HorizontalPanel();
        panelButtonControlDataBase.setHeight("50px");
        Button buttonAddUser = new Button("AddUser");

        buttonAddUser.addClickHandler(new ListenerAdmin("buttonAddUser", controllerAdmin));

        tableDataBaseUser.setWidget(0, 0, new Label("ID"));
        tableDataBaseUser.setWidget(0, 1, new Label("Login"));
        tableDataBaseUser.setWidget(0, 2, new Label("Password"));
        tableDataBaseUser.setWidget(0, 3, new Label("Name"));
        tableDataBaseUser.setWidget(0, 4, new Label("First Name"));
        tableDataBaseUser.setWidget(0, 5, new Label("E-mail address"));
        tableDataBaseUser.setWidget(0, 6, new Label("Status"));

        updateDataBase(result, tableDataBaseUser);

        this.add(buttonAddUser);
        this.add(tableDataBaseUser);

    }

    public void updateDataBase(List<User> result, FlexTable tableDataBaseUser) {

        for (int nbRow = 1; nbRow <= result.size(); nbRow++) {
            for (int nbCol = 0; nbCol < 9; nbCol++) {

                if (nbCol == 0) {
                    tableDataBaseUser.setWidget(nbRow, 0, new Label(result.get(nbRow - 1).getId()));
                }

                if (nbCol == 1) {
                    tableDataBaseUser.setWidget(nbRow, 1, new Label(result.get(nbRow - 1).getLogin()));
                }
                if (nbCol == 2) {
                    tableDataBaseUser.setWidget(nbRow, 2, new Label(result.get(nbRow - 1).getMdp()));
                }
                if (nbCol == 3) {
                    tableDataBaseUser.setWidget(nbRow, 3, new Label(result.get(nbRow - 1).getNom()));
                }
                if (nbCol == 4) {
                    tableDataBaseUser.setWidget(nbRow, 4, new Label(result.get(nbRow - 1).getPrenom()));
                }
                if (nbCol == 5) {
                    tableDataBaseUser.setWidget(nbRow, 5, new Label(result.get(nbRow - 1).getMail()));
                }
                if (nbCol == 6) {
                    tableDataBaseUser.setWidget(nbRow, 6, new Label(result.get(nbRow - 1).getStatus()));
                }
                if (nbCol == 7) {
                    Button buttonModify = new Button("Modify");
                    buttonModify.addClickHandler(new ListenerAdmin("buttonModifyUser", controllerAdmin));
                    tableDataBaseUser.setWidget(nbRow, 7, buttonModify);
                }
                if (nbCol == 8) {
                    Button buttonDelete = new Button("Delete");
                    tableDataBaseUser.setWidget(nbRow, 8, buttonDelete);
                }
            }

        }
    }

    public void clearDataBase(FlexTable tableDataBaseUser) {
        tableDataBaseUser.clear();
    }

    //************ GETTEURS  SETTEURS *************/

    public ControllerAdmin getControllerAdmin() {
        return controllerAdmin;
    }

}
