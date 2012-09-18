package rie6.client.vue;

import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;

import rie6.client.controleur.ControleurPrincipal;
/**
 * Bloque d'information sur l'utilisateur en cour + bouton de deconnection
 * @author nico
 *
 */
public class PanelInfoUser extends HorizontalPanel{

	public PanelInfoUser(final ControleurPrincipal controleurPrincipal) {
		// creation d'un panel
		
		this.add(new Label("Login: "));
		this.add(new Label(controleurPrincipal.getUser().getLogin_user()));
		Button disconnect = new Button("Logout");
		disconnect.addClickHandler(new ClickHandler() {
			
			@Override
			public void onClick(ClickEvent event) {
				controleurPrincipal.logout();
				
			}
		});
		this.add(disconnect);
	}

}
