package rie6.client.vue;

import rie6.client.controleur.ControleurPrincipal;
import rie6.client.model.MyPopup;
import com.google.gwt.event.dom.client.ClickEvent;
import com.google.gwt.event.dom.client.ClickHandler;
import com.google.gwt.event.dom.client.KeyCodes;
import com.google.gwt.event.dom.client.KeyPressEvent;
import com.google.gwt.event.dom.client.KeyPressHandler;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.FlexTable;
import com.google.gwt.user.client.ui.HasHorizontalAlignment;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.PasswordTextBox;
import com.google.gwt.user.client.ui.TextBox;
import com.google.gwt.user.client.ui.VerticalPanel;
import com.google.gwt.user.client.ui.FlexTable.FlexCellFormatter;

/**
 * Formulaire d'acceuil. Demande le login et mot de passe
 * La validation appel une methode qui vérifie le login sur la base de données
 * @author nico
 *
 */
public class LoginPage extends HorizontalPanel {
	//***********************************************
	//		Variables
	//***********************************************
	public ControleurPrincipal controleurPrincipal;
	public TextBox loginBox;
	public  PasswordTextBox mdpBox;
	
	//***********************************************
	//		Constructeur
	//***********************************************	
	public LoginPage (final ControleurPrincipal controleurPrincipal){
		 this.controleurPrincipal=controleurPrincipal;
		 this.setStyleName("div_login_page");
		 this.setHorizontalAlignment(ALIGN_CENTER);
		 
		//panel vertical
		VerticalPanel vPanel = new VerticalPanel();
		
		//creation d'un flexTable pour aligner les demandes d'informations
		FlexTable tableLoginMdp = new FlexTable();
		FlexCellFormatter cellFormatter = tableLoginMdp.getFlexCellFormatter();	//formatage des cellules
		tableLoginMdp.setCellSpacing(5);
		tableLoginMdp.setCellPadding(3);
		cellFormatter.setHorizontalAlignment(0, 1, HasHorizontalAlignment.ALIGN_LEFT);
		
		//insertion données fixe dans la colonne de gauche
		tableLoginMdp.setHTML(0, 0, "Login ");
		tableLoginMdp.setHTML(1, 0, "Mot de passe");
		
		//insertion des widgets
		loginBox = new TextBox();
		tableLoginMdp.setWidget(0, 1, loginBox);
		mdpBox = new PasswordTextBox();
		tableLoginMdp.setWidget(1, 1, mdpBox);
		
		//bouton valider
		Button login = new Button("Valider");
		tableLoginMdp.setWidget(2, 1, login);
		
		//ajout du tableau au panel
		tableLoginMdp.setStyleName("tableInfoPerso");
		vPanel.add(tableLoginMdp);
		
		//handler sur le bouton qui lance la recherche sur ldap suite au clik
		login.addClickHandler(new ClickHandler() {
			
			@Override
			public void onClick(ClickEvent event) {
				checkSaisie();
				
			}
		});
		
		//handler pour la touche entrée
		loginBox.addKeyPressHandler(new EnterHandler());
		mdpBox.addKeyPressHandler(new EnterHandler());
		
		// Ajout du panel vertical au panel en cours
		this.add(vPanel);
		
	}
	
	protected void checkSaisie() {
		if ((loginBox.getText().equals("")) || (mdpBox.getText().equals(""))){
			// le mec n'a pas rempli un ou plusieurs champs
			new MyPopup("Veuillez remplir tous les champs");
		}else{
			
			controleurPrincipal.testThisLoginNpwd(loginBox.getText().toString(),mdpBox.getText().toString());
		}
		
	}

	/**
	 * Handler qui lance le check de la saisie si la touche préssée est "entrer"
	 * @author nico
	 *
	 */
	public class EnterHandler  implements KeyPressHandler {

		@Override
		public void onKeyPress(KeyPressEvent event) {
			if (event.getCharCode() == KeyCodes.KEY_ENTER) {
				checkSaisie();
	        }
			
		}
		
	}

}
