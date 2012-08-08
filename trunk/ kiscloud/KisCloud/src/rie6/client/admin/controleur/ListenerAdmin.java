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

	}

}
