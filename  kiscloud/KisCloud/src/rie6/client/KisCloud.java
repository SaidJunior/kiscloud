package rie6.client;

import rie6.client.controleur.ControleurPrincipal;
import rie6.client.vue.LoginPage;

import com.google.gwt.core.client.EntryPoint;
import com.google.gwt.user.client.Cookies;
import com.google.gwt.user.client.ui.RootPanel;


/**
 * Point d'entrée de l'application KisCloud
 * @author nico
 *
 */
public class KisCloud implements EntryPoint {
	// Controleur princiapal
	private ControleurPrincipal controleurPrincipal = new ControleurPrincipal();
	
	@Override
	public void onModuleLoad() {
		// on réccupere le cookie local. 
		String id_cookie = Cookies.getCookie("KisCloud");
		// Si il existe on le test sur le serveur.
	    if ( id_cookie != null ){
	    	// un cookie existe. on test sur le serveur si il est tjs valide
	    	controleurPrincipal.checkThisID(id_cookie);
	    } else{
	    	// pas de cookie. on affiche la page de login
			RootPanel.get().add( new LoginPage(controleurPrincipal));
	    	
	    }

	}

}
