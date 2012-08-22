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
		
		//this.add(panelMenuManageUser,DockPanel.NORTH);
		
		controllerAdmin.getListUser();
		
		// Met la page "PageManageUser" sur le DockePanel principal
		controllerAdmin.getAdminPortal().add(this,DockPanel.CENTER);
	}

	
	public void setListUser(List<User> result) {
		
		System.out.println("J'ajoute ma grid pour la DataBase (PanelManageUser)");
		
		FlexTable tableDataBaseUser = new FlexTable();
		tableDataBaseUser.setStyleName("gridDataBase");
		tableDataBaseUser.setBorderWidth(2);
		
		FlexCellFormatter cellFormatter = tableDataBaseUser.getFlexCellFormatter();
		//tableDataBaseUser.addStyleName("cw-FlexTable");


		for(int nbRow=0 ; nbRow < result.size() ; nbRow ++){
			for (int nbCol=0 ; nbCol<=8; nbCol ++){
				
				
							/*******  Titre de la Base de Données *******/
				if(nbRow == 0 && nbCol== 0 ){
					tableDataBaseUser.setWidget(nbRow, nbCol,  new Label("ID" ));
				}
				
				if(nbRow == 0 && nbCol== 1 ){
					tableDataBaseUser.setWidget(nbRow, nbCol,  new Label("Login"));
				}
				
				if(nbRow == 0 && nbCol== 2 ){
					tableDataBaseUser.setWidget(nbRow, nbCol,  new Label("Password" ));
				}
				
				if(nbRow == 0 && nbCol== 3 ){
					tableDataBaseUser.setWidget(nbRow, nbCol,  new Label("Name" ));
				}
				
				if(nbRow == 0 && nbCol== 4 ){
					tableDataBaseUser.setWidget(nbRow, nbCol,  new Label("First Name" ));
				}
				
				if(nbRow == 0 && nbCol== 5 ){
					tableDataBaseUser.setWidget(nbRow, nbCol,  new Label("Mail" ));
				}
				
				if(nbRow == 0 && nbCol== 6 ){
					tableDataBaseUser.setWidget(nbRow, nbCol,  new Label("Status" ));
				}
				
							/************************************/
				
				
								/*********  DATA *********/
				if(nbRow !=0 && nbCol== 1){
				
				}
				
				if(nbRow !=0 && nbCol== 2){
					
				}
				if(nbRow !=0 && nbCol== 3){
					
				}
				if(nbRow !=0 && nbCol== 4){
					
				}
				if(nbRow !=0 && nbCol== 5){
					
				}
				if(nbRow !=0 && nbCol== 6){
					
				}
				if(nbRow !=0 && nbCol== 7){
					Button buttonModifyUser = new Button("Modify");
					tableDataBaseUser.setWidget(nbRow, 7,  buttonModifyUser = new Button("Modify"));	
				}
				if(nbRow !=0 && nbCol== 8){
					Button buttonDeleteUserButton = new Button ("Delete");
					tableDataBaseUser.setWidget(nbRow, 8, buttonDeleteUserButton );	
				}
			}	
			
		}
		
		this.add(tableDataBaseUser);
		
//		for(User user : result){
//			
//		}
	}
	
	//************ GETTEURS  SETTEURS *************/

	public ControllerAdmin getControllerAdmin() {
		return controllerAdmin;
	}
	

}
