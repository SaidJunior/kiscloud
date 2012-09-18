package rie6.client.vue;

import com.google.gwt.user.client.ui.DockPanel;
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
	PanelListVM PanelListVM;
	//***************************
	//		Constructeur
	//***************************	
	public ClientPortal(final ControleurPrincipal controleurPrincipal) {
		this.controleurPrincipal=controleurPrincipal;
		this.setSize("800px", "600px");
		this.setStyleName("clientPortal");
		
		//*********************************
		//		Info user + bouton logout
		//*********************************
		PanelInfoUser panelInfoUser = new PanelInfoUser(controleurPrincipal);
		this.add(panelInfoUser,DockPanel.NORTH);
		
		//***************************
		//		Menu de gauche
		//***************************	
		PanelMenuGauche panelMenuGauche = new PanelMenuGauche(controleurPrincipal);
		this.add(panelMenuGauche,DockPanel.WEST);
		
		//***************************************
		//		Creation des conteneurs de page
		//***************************************
		PanelListVM = new PanelListVM(controleurPrincipal);
		this.add(PanelListVM,DockPanel.EAST);

	}

}
