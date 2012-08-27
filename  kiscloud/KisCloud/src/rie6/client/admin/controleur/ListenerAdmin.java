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
		
		//**** MENU BUTTON ****// 
		
		if (id.equals("buttonManageUser")){		
			PageManageUser pageManageUser = new PageManageUser(controllerAdmin);
			
		}
		
		if (id.equals("buttonManageNode")){		
			
		}
		
		if (id.equals("buttonViewRessources")){		
			
		}
		
		if (id.equals("buttonListVMUsers")){		
			
		}
		if (id.equals("buttonLogs")){		
			
		}
		
		//**** PAGE MANAGE USER **** //
		
		if (id.equals("buttonAddUser")){		
			System.out.println("je clique pour ajouter un utilisateur dans la base");
		}
		
		if (id.equals("buttonModifyUser")){	
			System.out.println("je clique pour modifier un utilisateur dans la base");
			
		}
		
		if (id.equals("buttonDeleteUser")){		
			System.out.println("je clique pour supprimer un utilisateur dans la base");
		}
		
		
	}

}
