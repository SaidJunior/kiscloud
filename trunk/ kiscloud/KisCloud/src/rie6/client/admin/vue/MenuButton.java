package rie6.client.admin.vue;

import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.VerticalPanel;
import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.controleur.ListenerAdmin;

public class MenuButton extends VerticalPanel{
	
	private ControllerAdmin controllerAdmin;

	public MenuButton(ControllerAdmin controllerAdmin) {
		
		this.controllerAdmin = controllerAdmin;
		
		this.setSize("200px", "500px");
		
		Button buttonManageUser = new Button("MANAGE USERS");
		buttonManageUser.addClickHandler(new ListenerAdmin("buttonManageUser", controllerAdmin));
		buttonManageUser.setStyleName("menuButton ");
		
		Button buttonManageNode = new Button("MANAGE NODE");
		buttonManageNode.addClickHandler(new ListenerAdmin("buttonManageNode", controllerAdmin));
		buttonManageNode.setStyleName("menuButton ");
		
		Button buttonViewRessources = new Button("VIEW RESSOURCES");
		buttonViewRessources.addClickHandler(new ListenerAdmin("buttonViewRessources", controllerAdmin));
		buttonViewRessources.setStyleName("menuButton ");
		
		Button buttonListVMUsers = new Button("LIST VM'S USERS");
		buttonListVMUsers.addClickHandler(new ListenerAdmin("buttonListVMUsers", controllerAdmin));
		buttonListVMUsers.setStyleName("menuButton ");
		
		Button buttonLogs = new Button("LOGS");
		buttonLogs.addClickHandler(new ListenerAdmin("buttonLogs", controllerAdmin));
		buttonLogs.setStyleName("menuButton ");

		this.add(buttonManageUser);
		this.add(buttonManageNode);
		this.add(buttonViewRessources);
		this.add(buttonListVMUsers);
		this.add(buttonLogs);
		
		
	}

}
