package rie6.client.admin.vue;

import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.VerticalPanel;
import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.controleur.ListenerAdmin;

public class MenuButton extends VerticalPanel{
	
	private ControllerAdmin controllerAdmin;

	public MenuButton(ControllerAdmin controllerAdmin) {
		
		this.controllerAdmin = controllerAdmin;
		
		this.setSize("200px", "500px");
		this.setBorderWidth(5);
		
		Button buttonManageUser = new Button("MANAGE USERS");
		buttonManageUser.addClickHandler(new ListenerAdmin("buttonManageUser", controllerAdmin));
		//buttonManageUser.setStyleName("menuButton");
		buttonManageUser.setWidth("200px");
		buttonManageUser.setHeight("100px");
		
		Button buttonManageNode = new Button("MANAGE NODE");
		buttonManageNode.addClickHandler(new ListenerAdmin("buttonManageNode", controllerAdmin));
		buttonManageNode.setWidth("200px");
		buttonManageNode.setHeight("100px");
		
		Button buttonViewRessources = new Button("VIEW RESSOURCES");
		buttonViewRessources.addClickHandler(new ListenerAdmin("buttonViewRessources", controllerAdmin));
		buttonViewRessources.setWidth("200px");
		buttonViewRessources.setHeight("100px");
		
		Button buttonListVMUsers = new Button("LIST VM'S USERS");
		buttonListVMUsers.addClickHandler(new ListenerAdmin("buttonListVMUsers", controllerAdmin));
		buttonListVMUsers.setWidth("200px");
		buttonListVMUsers.setHeight("100px");
		
		Button buttonLogs = new Button("LOGS");
		buttonLogs.addClickHandler(new ListenerAdmin("buttonLogs", controllerAdmin));
		buttonLogs.setWidth("200px");
		buttonLogs.setHeight("100px");

		this.add(buttonManageUser);
		this.add(buttonManageNode);
		this.add(buttonViewRessources);
		this.add(buttonListVMUsers);
		this.add(buttonLogs);
		
		
	}

}
