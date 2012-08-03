package rie6.client.admin.vue;

import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.VerticalPanel;
import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.controleur.ListenerAdmin;

public class MenuButton extends VerticalPanel{
	
	private ControllerAdmin controllerAdmin;

	public MenuButton(ControllerAdmin controllerAdmin) {
		
		this.controllerAdmin = controllerAdmin;
		
//		this.setBorderWidth(5);
		
		Button buttonManageUser = new Button("MANAGE USERS");
		buttonManageUser.addClickHandler(new ListenerAdmin("buttonManageUser", controllerAdmin));
		buttonManageUser.setWidth("300px");
		
		Button buttonManageNode = new Button("MANAGE NODE");
		buttonManageNode.addClickHandler(new ListenerAdmin("buttonManageNode", controllerAdmin));
		buttonManageNode.setWidth("300px");
		
		Button buttonViewRessources = new Button("VIEW RESSOURCES");
		buttonViewRessources.addClickHandler(new ListenerAdmin("buttonViewRessources", controllerAdmin));
		buttonViewRessources.setWidth("300px");
		
		Button buttonListVMUsers = new Button("LIST VM'S USERS");
		buttonListVMUsers.addClickHandler(new ListenerAdmin("buttonListVMUsers", controllerAdmin));
		buttonListVMUsers.setWidth("300px");
		
		Button buttonLogs = new Button("LOGS");
		buttonLogs.addClickHandler(new ListenerAdmin("buttonLogs", controllerAdmin));
		buttonLogs.setWidth("300px");
		

		this.add(buttonManageUser);
		this.add(buttonManageNode);
		this.add(buttonViewRessources);
		this.add(buttonListVMUsers);
		this.add(buttonLogs);
		
	}

}
