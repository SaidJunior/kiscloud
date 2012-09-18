package rie6.client.vue;

import com.google.gwt.cell.client.ActionCell;
import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;
import com.google.gwt.user.cellview.client.CellTable;
import com.google.gwt.user.cellview.client.TextColumn;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.FlexTable;
import com.google.gwt.user.client.ui.HasHorizontalAlignment;
import com.google.gwt.user.client.ui.VerticalPanel;
import com.google.gwt.user.client.ui.FlexTable.FlexCellFormatter;


import rie6.client.controleur.ControleurPrincipal;
import rie6.client.model.VM;

public class PanelListVM extends VerticalPanel{
	//**********************
	// variables globales
	//**********************
	private FlexTable tableVM;
	//**********************
	// Constructeur
	//**********************
	public PanelListVM(final ControleurPrincipal controleurPrincipal) {
		this.setSize("800px", "500px");
		this.setBorderWidth(5);
		this.setHorizontalAlignment(HasHorizontalAlignment.ALIGN_CENTER);	//centrage des elements
		
		//*******************************
		// bouton pour la creation de VM
		//*******************************
		Button createVM = new Button("Nouvelle VM");
		createVM.addClickHandler(new ClickHandler() {
			
			@Override
			public void onClick(ClickEvent event) {
				// TODO creer le formulaire de creation de vm
				
			}
		});
		this.add(createVM);
		
		//*******************************
		// Liste des VM de l'utilisateur
		//*******************************
		//creation d'un flexTable
		tableVM = new FlexTable();
		FlexCellFormatter cellFormatter = tableVM.getFlexCellFormatter();	//formatage des cellules
		tableVM.setCellSpacing(5);
		tableVM.setCellPadding(3);
		
		//ajout celltable de VM
		CellTable<VM> tableVM = new CellTable<VM>();
		
		//colonne Nb proc
		TextColumn<VM> nbCoreColumn = new TextColumn<VM>() {

			@Override
			public String getValue(VM vm) {
				
				return String.valueOf(vm.getNbCore());
			}
		};
		
		//colonne Memoire
		TextColumn<VM> ramColumn = new TextColumn<VM>() {

			@Override
			public String getValue(VM vm) {
				
				return String.valueOf(vm.getRam());
			}
		};
		//colonne Status
		TextColumn<VM> statusColumn = new TextColumn<VM>() {

			@Override
			public String getValue(VM vm) {
				
				return vm.getStatus();
			}
		};
		
		//colonne Disque dur
		ActionCell<VM>buttonShowDiskVM =new ActionCell<VM>("Afficher disques", new ActionCell.Delegate<VM>(){

			@Override
			public void execute(VM vm) {
				//demande au controleur d'afficher la liste des disk rattachés a la vm
				controleurPrincipal.showDiskVMof(vm.getId());
			}
		})	;
		
		//colonne isoName
		TextColumn<VM> isoName = new TextColumn<VM>() {

			@Override
			public String getValue(VM vm) {
				
				return vm.getIsoName();
			}
		};
		
		//colonne Action
		ActionCell<VM>buttonAction =new ActionCell<VM>("Action", new ActionCell.Delegate<VM>(){

			@Override
			public void execute(VM vm) {
				//demande au controleur d'arreter ou demmarer la vm suivant son etat
				controleurPrincipal.startOrStopThisVM(vm.getId());
			}
		})	;
		
	}
	
	//**********************
	// Getter et setter
	//**********************
	
	//**********************
	// Methode
	//**********************

}
