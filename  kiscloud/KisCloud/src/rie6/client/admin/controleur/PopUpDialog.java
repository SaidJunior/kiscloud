package rie6.client.admin.controleur;

import rie6.client.admin.vue.PageManageUser;

import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.DialogBox;
import com.google.gwt.user.client.ui.Grid;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.ListBox;
import com.google.gwt.user.client.ui.TextBox;
import com.google.gwt.user.client.ui.VerticalPanel;

public class PopUpDialog extends DialogBox {

    private final ControllerAdmin controllerAdmin;

    public PopUpDialog(final ControllerAdmin controllerAdmin) {
        super();
        this.controllerAdmin = controllerAdmin;
        setGlassEnabled(true);
        setAnimationEnabled(true);
        this.setStyleName("background-color:green");
        this.setVisible(true);
        setModal(true);
        setText("Add User");
        setSize("100", "200");

        // Panel qui contient tout les éléments de la PopUpDialog
        VerticalPanel dialogContents = new VerticalPanel();
        dialogContents.setBorderWidth(2);
        dialogContents.setSpacing(4);
        dialogContents.setSize("50", "100");
        dialogContents.setStyleName("dialogBox");
        dialogContents.setVisible(true);
        this.setWidget(dialogContents);

        //Grid qui permet d'ajouter un utilisateur 
        Grid gridAddUser = new Grid(6, 2);
        createGridAddUser(gridAddUser);

        // Panel qui va contenir les boutons de controle de la PopUpDialog
        HorizontalPanel panelButtonAddUser = new HorizontalPanel();

        Button closeButton = new Button("close");

        //        closeButton.addClickHandler(new ListenerAdmin("buttonClosePanelAddUser", controllerAdmin));

        closeButton.addClickHandler(new ClickHandler() {
            @Override
            public void onClick(ClickEvent event) {
                closeDialogBox();
                PageManageUser pageManageUser = controllerAdmin.getPageManageUser();
                pageManageUser.setVisible(true);

            }
        });

        Button saveButton = new Button("save");

        panelButtonAddUser.add(saveButton);
        panelButtonAddUser.add(closeButton);

        dialogContents.add(gridAddUser);
        dialogContents.add(panelButtonAddUser);
    }

    private void closeDialogBox() {
        this.hide();
    }

    private Grid createGridAddUser(Grid grid) {

        grid.setBorderWidth(2);
        grid.setWidget(0, 0, new Label("Login"));
        grid.setWidget(1, 0, new Label("Password"));
        grid.setWidget(2, 0, new Label("Name"));
        grid.setWidget(3, 0, new Label("First Name"));
        grid.setWidget(4, 0, new Label("E-mail address"));
        grid.setWidget(5, 0, new Label("Status"));

        TextBox textLogin = new TextBox();
        TextBox textPassword = new TextBox();
        TextBox textName = new TextBox();
        TextBox textFirstName = new TextBox();
        TextBox textEmail = new TextBox();

        ListBox listStatus = new ListBox();
        listStatus.addItem("admin");
        listStatus.addItem("client");

        grid.setWidget(0, 1, textLogin);
        grid.setWidget(1, 1, textPassword);
        grid.setWidget(2, 1, textName);
        grid.setWidget(3, 1, textFirstName);
        grid.setWidget(4, 1, textEmail);
        grid.setWidget(5, 1, listStatus);

        return grid;

    }
}
