package rie6.client.admin.controleur;

import rie6.client.admin.vue.PageManageUser;

import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;


public class ListenerAdmin implements ClickHandler {

	private ControllerAdmin controllerAdmin;
	private String id = null;
	
	public ListenerAdmin(String id, ControllerAdmin controllerAdmin){
		
		this.controllerAdmin =controllerAdmin;
		this.id=id;
	}
	
	@Override
	public void onClick(ClickEvent event) {
		
		if (id.equals("buttonManageUser")){		
			System.out.println("** Je clique sur le bouton : MANAGE USERS **");
			PageManageUser pageManageUser = new PageManageUser(controllerAdmin);
			
		}
		
		if (id.equals("buttonManageNode")){		
			System.out.println("** Je clique sur le bouton : MANAGE NODE **");
			
		}
		
		if (id.equals("buttonViewRessources")){		
			System.out.println("** Je clique sur le bouton : VIEW RESSOURCES **");
			
		}
		
		if (id.equals("buttonListVMUsers")){		
			System.out.println("** Je clique sur le bouton : LIST VM'S USERS **");
			
		}
		if (id.equals("buttonLogs")){		
			System.out.println("** Je clique sur le bouton : LOGS **");
			
		}

	}

}
