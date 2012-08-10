package rie6.client.admin.vue;

import java.util.List;



import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.DockPanel;

import com.google.gwt.user.client.ui.Grid;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.VerticalPanel;

import com.mysql.jdbc.ResultSetRow;

import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.controleur.ListenerAdmin;
import rie6.client.admin.model.GridTitle;
import rie6.client.admin.model.User;

public class PageManageUser extends HorizontalPanel{
	
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
		
		System.out.println("J'ajoute ma grid");
		
		Grid gridTitle = new Grid(1, 8);
		
		gridTitle.setWidget(1, 2, new Button("Does nothing, but could"));
		
		//GridTitle gridTitle = new GridTitle();
		gridTitle.setStyleName("gridTitle");
		
		
		// exemples 
		
		Grid g = new Grid(5, 5);

	    // Put some values in the grid cells.
	    for (int row = 0; row < 5; ++row) {
	      for (int col = 0; col < 5; ++col)
	        g.setText(row, col, "" + row + ", " + col);
	    }

	    // Just for good measure, let's put a button in the center.
	    g.setWidget(2, 2, new Button("Does nothing, but could"));

	    // You can use the CellFormatter to affect the layout of the grid's cells.
	    g.getCellFormatter().setWidth(0, 2, "256px");
		
		g.setStyleName("gridTitle");
		
	    this.add(g);
		
		
		
		//this.add(gridTitle);

		for(User user : result){
			
		}

	}
	
	//************ GETTEURS  SETTEURS *************/

	public ControllerAdmin getControllerAdmin() {
		return controllerAdmin;
	}
	
	
	

}
