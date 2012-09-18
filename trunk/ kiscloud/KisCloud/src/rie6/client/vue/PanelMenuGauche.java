package rie6.client.vue;

import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.VerticalPanel;

import rie6.client.controleur.ControleurPrincipal;
/**
 * Menude gauche avec les boutons pour ouvrir les fenetres
 * @author nico
 *
 */
public class PanelMenuGauche extends VerticalPanel{

	public PanelMenuGauche(final ControleurPrincipal controleurPrincipal) {
		this.setBorderWidth(5);
		//*************************
		// creation des boutons
		//*************************
		// bouton liste des VM
		Button listVmButton = new Button("Mes VMs");
		listVmButton.addClickHandler(new ClickHandler() {
			
			@Override
			public void onClick(ClickEvent event) {
				controleurPrincipal.showListVM();				
			}
		});
		
		// bouton Mes disques virtuels
		Button listDiskVMButton = new Button("Mes disques virtuels");
		
		// bouton liste iso
		Button listISOButton = new Button("Mes ISOs");
		
		// bouton journal d'evement
		Button logs = new Button("Logs");
		
		//*************************
		// Ajout a 'interface
		//*************************
		this.add(listVmButton);
		this.add(listDiskVMButton);
		this.add(listISOButton);
		this.add(logs);
	}

}
