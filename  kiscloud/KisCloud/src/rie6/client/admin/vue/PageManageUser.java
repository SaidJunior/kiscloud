package rie6.client.admin.vue;

import java.util.List;

import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.DockPanel;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.VerticalPanel;

import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.controleur.ListenerAdmin;
import rie6.client.admin.model.User;

public class PageManageUser extends DockPanel{
	
	private ControllerAdmin controllerAdmin;
	private List<User> listUser;

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
		
		this.add(panelMenuManageUser,DockPanel.NORTH);
		
		controllerAdmin.getListUser();
		
		controllerAdmin.getAdminPortal().add(this,DockPanel.CENTER);
	}

	public void setListUser(List<User> result) {
		for(User user : result){
			System.out.println(user.getLogin());
			
		}
		
	}

}
