package rie6.client.admin.controleur;

import rie6.client.admin.vue.PageManageUser;

import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.DialogBox;
import com.google.gwt.user.client.ui.VerticalPanel;

public class ListenerAdmin implements ClickHandler {

    private final ControllerAdmin controllerAdmin;
    private PageManageUser        pageManageUser;
    private String                id = null;

    public ListenerAdmin(String id, ControllerAdmin controllerAdmin) {

        this.controllerAdmin = controllerAdmin;
        this.id = id;
    }

    @Override
    public void onClick(ClickEvent e) {

        //**** MENU BUTTON ****// 

        if (id.equals("buttonManageUser")) {
            pageManageUser = new PageManageUser(controllerAdmin);
        }

        if (id.equals("buttonManageNode")) {
            System.out.println("je clique pour ManageNode");
        }

        if (id.equals("buttonViewRessources")) {
            System.out.println("je clique sur ViewRessources");
        }

        if (id.equals("buttonListVMUsers")) {
            System.out.println("je clique sur ListVMUsers");

        }
        if (id.equals("buttonLogs")) {

        }

        //**** POPUP DIALOG **** //

        if (id.equals("buttonClosePanelAddUser")) {
            System.out.println("je clique pour fermer la dialogBox pour ajouter un User");
            Button buttonCloseAddUser = (Button) e.getSource();

            PopUpDialog popUpDialog = (PopUpDialog) buttonCloseAddUser.getParent();

        }

        //**** PAGE MANAGE USER **** //

        if (id.equals("buttonAddUser")) {
            System.out.println("je clique pour ajouter un utilisateur dans la base");

            Button buttonAdd = (Button) e.getSource();
            PageManageUser pageManageUser = (PageManageUser) buttonAdd.getParent();
            pageManageUser.setVisible(false);

            PopUpDialog popUpDialog = new PopUpDialog(controllerAdmin);

            popUpDialog.center();
            popUpDialog.show();

        }

        if (id.equals("buttonModifyUser")) {
            System.out.println("je clique pour modifier un utilisateur dans la base");

            final DialogBox dialogBox = new DialogBox();
            dialogBox.setGlassEnabled(true);
            dialogBox.setAnimationEnabled(true);

            VerticalPanel dialogContents = new VerticalPanel();
            dialogContents.setSpacing(4);
            dialogBox.setWidget(dialogContents);

            Button closeButton = new Button();
            closeButton.addClickHandler(new ClickHandler() {
                @Override
                public void onClick(ClickEvent event) {
                    dialogBox.hide();
                }
            });

            dialogContents.add(closeButton);
            dialogBox.show();

        }

        if (id.equals("buttonDeleteUser")) {
            System.out.println("je clique pour supprimer un utilisateur dans la base");
        }

    }

    public ControllerAdmin getControllerAdmin() {
        return controllerAdmin;
    }

    public PageManageUser getPageManageUser() {
        return pageManageUser;
    }

}
