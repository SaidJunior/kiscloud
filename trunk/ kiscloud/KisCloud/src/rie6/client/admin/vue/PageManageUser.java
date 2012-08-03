package rie6.client.admin.vue;

import java.util.List;

import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.VerticalPanel;

import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.model.User;

public class PageManageUser extends VerticalPanel{
	
	private ControllerAdmin controllerAdmin;
	private List<User> listUser;

	public PageManageUser(ControllerAdmin controllerAdmin) {
		
		this.controllerAdmin = controllerAdmin;
		
		Label label = new Label();
		
		//controllerAdmin.getListUser();
	}

}
