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
		this.setSize("800px", "800px");
		
		this.controllerAdmin.setPageManageListUser(this);
		
		HorizontalPanel panelButtonToManageUser = new HorizontalPanel();
		panelButtonToManageUser.setHorizontalAlignment(ALIGN_RIGHT);
		
		Button buttonAddUser = new Button("Add User");
		buttonAddUser.addClickHandler(new ListenerAdmin("buttonAddUser", controllerAdmin));
		
		Button buttonModifyUser = new Button("Modify");
		buttonModifyUser.addClickHandler(new ListenerAdmin("buttonModifyUser", controllerAdmin));
		
		Button buttonDeleteUser = new Button("Delete");
		buttonDeleteUser.addClickHandler(new ListenerAdmin("buttonDeleteUser", controllerAdmin));
		
		panelButtonToManageUser.add(buttonAddUser);
		panelButtonToManageUser.add(buttonModifyUser);
		panelButtonToManageUser.add(buttonDeleteUser);
		
		this.add(panelButtonToManageUser,DockPanel.NORTH);
		
		controllerAdmin.getListUser();
		
		controllerAdmin.getAdminPortal().add(this,DockPanel.CENTER);
	}

	public void setListUser(List<User> result) {
		for(User user : result){
			System.out.println(user.getLogin());
			
		}
		
	}

}
