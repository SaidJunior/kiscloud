package rie6.client.vue;

import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.DockPanel;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;

import rie6.client.controleur.ControleurPrincipal;

/**
 * Page d'acceuil de l'interface client
 * @author nico
 *
 */
public class ClientPortal extends DockPanel{
	//***************************
	//		Variables
	//***************************
	ControleurPrincipal controleurPrincipal;
	
	//***************************
	//		Constructeur
	//***************************	
	public ClientPortal(final ControleurPrincipal controleurPrincipal) {
		this.controleurPrincipal=controleurPrincipal;
		this.setSize("800px", "600px");
		this.setStyleName("clientPortal");
		//***************************
		//		Info user
		//***************************	
		HorizontalPanel hpan = new HorizontalPanel();
		hpan.add(new Label("Login: "));
		hpan.add(new Label(controleurPrincipal.getUser().getLogin_user()));
		Button disconnect = new Button("Logout");
		disconnect.addClickHandler(new ClickHandler() {
			
			@Override
			public void onClick(ClickEvent event) {
				controleurPrincipal.logout();
				
			}
		});
		hpan.add(disconnect);
		//ajout au north du dock
		this.add(hpan,DockPanel.NORTH);
		
		//***************************
		//		Menu de gauche
		//***************************	

	}

}
