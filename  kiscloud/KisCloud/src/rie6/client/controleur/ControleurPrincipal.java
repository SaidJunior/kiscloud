package rie6.client.controleur;

import java.util.Date;

import rie6.client.admin.controleur.ControllerAdmin;
import rie6.client.admin.vue.AdminPortal;
import rie6.client.model.MyPopup;
import rie6.client.model.MyUser;
import rie6.client.model.RPCservice;
import rie6.client.model.RPCserviceAsync;
import rie6.client.vue.ClientPortal;
import rie6.client.vue.LoginPage;

import com.google.gwt.core.client.GWT;
import com.google.gwt.user.client.Cookies;
import com.google.gwt.user.client.rpc.AsyncCallback;
import com.google.gwt.user.client.ui.RootPanel;

public class ControleurPrincipal {
	//*************************************
	//		Variables
	//*************************************	
	MyUser user;
	ClientPortal clientPortal;
	/**
	 * Effectue un appel RPC sur le serveur pour tester le cookie.
	 * Si c'est ok on affiche la page d'acceuil sinon le formulaire de login
	 * @param sessionID
	 * 			Numéro de cookie a tester de type string
	 */
	public void checkThisID(String id_cookie) {
		//déclaration du service
		RPCserviceAsync testCookie = GWT.create(RPCservice.class);
		
		// Creation du callback pour recup la reponse serveur
		AsyncCallback<String[]> callback = new AsyncCallback<String[]>() {

			@Override
			public void onFailure(Throwable caught) {
				new MyPopup("Erreur serveur");
				
			}
			@Override
			public void onSuccess(String result[]) {
				
				if(result[0]==null){
					// id pas bon on propose le log classic via formulaire
					AffichePageLogin();
				}else{
					//on a reçu les infos d'un client. on créé l'objet user
					user= new MyUser(result[0], result[1], result[2], result[3], result[4], result[5],result[6]);
									    
					// suivant le status de l'user on redirige vers la bonne page
					if (user.getStatus_user().equals("admin")){
						AffichePageAcceuilAdmin();
					}else{
						//dans l'autre cas c'est un client
						AffichePageAcceuilClient();
					}
				}
				
			}
			
		};
		// Effectue l'appel au service distant
		testCookie.testThisCookie(id_cookie,callback);		
		
	}

	
	/**
	 * Affiche la page de demande de login
	 */
	protected void AffichePageLogin() {
		new LoginPage(this);
	}
	
	/**
	 * Effectue un appel RPC pour tester le login et mot de passe dans la base de données
	 * @param login		
	 * 			String du login client
	 * @param pwd
	 * 			String du mot de passe client
	 */
	public void testThisLoginNpwd(String login, String pwd) {
		//déclaration du service
		RPCserviceAsync testLoginPwd = GWT.create(RPCservice.class);
		
		// Creation du callback pour recup la reponse serveur
		AsyncCallback<String[]> callback = new AsyncCallback<String[]>() {

			@Override
			public void onFailure(Throwable caught) {
				new MyPopup("Erreur serveur");
				
			}
			@Override
			public void onSuccess(String result[]) {
				
				if(result[0]==null){
					// login ou mot de passe incorect
					new MyPopup("Login ou mot de passe incorrect");
				}else{
					//on a reçu les infos d'un client. on créé l'objet user
					user= new MyUser(result[0], result[1], result[2], result[3], result[4], result[5],result[6]);
					
					// creation du cookie coté client
					System.out.println("Nouveau cookie: "+ user.getId_cookie());
					final long DURATION = 1000 * 60 * 60 * 24 * 14; //duration remembering login. 2 weeks in this example.
				    Date expires = new Date(System.currentTimeMillis() + DURATION);
				    Cookies.setCookie("KisCloud", user.getId_cookie(), expires, null, "/", false);
				    
					// suivant le status de l'user on redirige vers la bonne page
					if (user.getStatus_user().equals("admin")){
						AffichePageAcceuilAdmin();
					}else{
						//dans l'autre cas c'est un client
						AffichePageAcceuilClient();
					}
					
				}
				
			}
			
		};
		// Effectue l'appel au service distant
		testLoginPwd.checkThisLoginNpwd(login,pwd,callback);
		
		
	}

	protected void AffichePageAcceuilClient() {
		//TODO Nico: faire la page accueil client
		System.out.println("j'affiche l'interface client");
		RootPanel.get().clear();
		clientPortal = new ClientPortal(this);
		RootPanel.get().add(clientPortal);
	}


	protected void AffichePageAcceuilAdmin() {
		
		System.out.println("je vais afficher la page d'administration");
		
		//rootpanel.get.clean
		RootPanel.get().clear();
		ControllerAdmin controllerAdmin = new ControllerAdmin();
		AdminPortal adminPortal = new AdminPortal(controllerAdmin);
		RootPanel.get().add(adminPortal);
		
	}

	//*************************************
	//		Getter et setter
	//*************************************	
	public MyUser getUser() {
		return user;
	}

	/**
	 * Decoonect le client de l'interface
	 */
	public void logout() {
		this.clientPortal.setVisible(false);
		Date expires = new Date(System.currentTimeMillis()) ;
		Cookies.setCookie("KisCloud", "null", expires, null, "/", false);
		RootPanel.get().add(new LoginPage(this));
		
	}

}
