package rie6.client.admin.vue;

import com.google.gwt.user.client.ui.DockPanel;

import rie6.client.admin.controleur.ControllerAdmin;



public class AdminPortal extends DockPanel{

	private ControllerAdmin controllerAdmin;

	public AdminPortal(ControllerAdmin controllerAdmin) {
		
		System.out.println(" j'affiche la page d'administration");
		
		this.controllerAdmin = controllerAdmin;
		controllerAdmin.setAdminPortal(this);
		
//		this.setSize("100%", "100%");
//		this.setBorderWidth(5);
//		this.setStyleName("panelAdminPortal");
		
		this.setHorizontalAlignment(DockPanel.ALIGN_CENTER);
		
		// Creation du panel de bouton pour manager la partie admin
		MenuButton menuButton = new MenuButton(controllerAdmin);
		
		
		//placement des panels sur le portail
		this.add(menuButton,DockPanel.WEST);
	}

}
