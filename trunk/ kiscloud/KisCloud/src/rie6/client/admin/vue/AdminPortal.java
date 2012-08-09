package rie6.client.admin.vue;

import java.awt.peer.LabelPeer;

import com.google.gwt.user.client.ui.DockPanel;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;

import rie6.client.admin.controleur.ControllerAdmin;



public class AdminPortal extends DockPanel{

	private ControllerAdmin controllerAdmin;

	public AdminPortal(ControllerAdmin controllerAdmin) {
		
		this.controllerAdmin = controllerAdmin;
		controllerAdmin.setAdminPortal(this);
	
		this.setBorderWidth(5);
		this.setStyleName("panelAdminPortal");

		// Creation du panel de bouton pour manager la partie admin
		MenuButton menuButton = new MenuButton(controllerAdmin);
	
		HorizontalPanel horizontalPanelTitre = new HorizontalPanel();
		horizontalPanelTitre.setStyleName("headBandPresentation");
		Label labelBandeau = new Label("PORTAL ADMINISTRATION");
		horizontalPanelTitre.add(labelBandeau);

		//placement des panels sur le portail
		this.add(horizontalPanelTitre, DockPanel.NORTH); 	
		this.add(menuButton,DockPanel.WEST);
		
	}

}
