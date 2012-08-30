package rie6.client.admin.vue;

import java.util.List;

import javax.swing.text.EditorKit;

import com.google.gwt.cell.client.EditTextCell;
import com.google.gwt.user.cellview.client.CellTable;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.DockPanel;

import com.google.gwt.user.client.ui.FlexTable;
import com.google.gwt.user.client.ui.FlexTable.FlexCellFormatter;
import com.google.gwt.user.client.ui.Grid;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.IsWidget;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.ScrollPanel;
import com.google.gwt.user.client.ui.TextArea;
import com.google.gwt.user.client.ui.VerticalPanel;

import com.mysql.jdbc.ResultSetRow;

import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.controleur.ListenerAdmin;
import rie6.client.admin.model.GridTitle;
import rie6.client.admin.model.User;

public class PageManageUser extends VerticalPanel{
	
	private ControllerAdmin controllerAdmin;

	
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
		controllerAdmin.getAdminPortal().add(this,DockPanel.CENTER);
	}

	
	public void setListUser(List<User> result) {
		
		System.out.println("J'ajoute ma grid pour la DataBase (PanelManageUser)");
		
		
		ScrollPanel scrollPanel = new ScrollPanel();
	    scrollPanel.setSize("800", "800");    
		
		FlexTable tableDataBaseUser = new FlexTable();
		tableDataBaseUser.setStyleName("gridDataBase");
		tableDataBaseUser.setBorderWidth(2);
		scrollPanel.add(tableDataBaseUser);

		FlexCellFormatter cellFormatter = tableDataBaseUser.getFlexCellFormatter();
		//tableDataBaseUser.addStyleName("cw-FlexTable");

		HorizontalPanel panelButtonControlDataBase = new HorizontalPanel();
		Button buttonAddUser = new Button("AddUser");

		buttonAddUser.addClickHandler(new ListenerAdmin("buttonAddUser", controllerAdmin));
		
		
		tableDataBaseUser.setWidget(0, 0,  new Label("ID" ));
		tableDataBaseUser.setWidget(0, 1,  new Label("Login"));
		tableDataBaseUser.setWidget(0, 2,  new Label("Password" ));
		tableDataBaseUser.setWidget(0, 3,  new Label("Name" ));
		tableDataBaseUser.setWidget(0, 4,  new Label("First Name" ));
		tableDataBaseUser.setWidget(0, 5,  new Label("Mail" ));
		tableDataBaseUser.setWidget(0, 6,  new Label("Status" ));
		
		for(int nbRow=1 ; nbRow < result.size() ; nbRow ++){
			for (int nbCol=0 ; nbCol<8; nbCol ++){

				
				if(nbCol== 0){
				}
				
				if(nbCol== 1){

				}
				if(nbCol== 2){

				}
				if(nbCol== 3){
	
				}
				if(nbCol== 4){

				}
				if(nbCol== 5){
			
				}
				if(nbCol== 6){
				
				}
				if(nbCol== 7){
					Button buttonModify = new Button("Modify");
					buttonModify.addClickHandler(new ListenerAdmin("buttonModifyUser", controllerAdmin));
					tableDataBaseUser.setWidget(nbRow, 7, buttonModify );
				}
			}	
			
		}
		this.add(buttonAddUser);
		this.add(scrollPanel);
//		this.add(tableDataBaseUser);
		
//		for(User user : result){
//			
//		}
	}
	
	//************ GETTEURS  SETTEURS *************/

	public ControllerAdmin getControllerAdmin() {
		return controllerAdmin;
	}
	

}
