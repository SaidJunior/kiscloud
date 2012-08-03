package rie6.client.model;

public class MyUser {
	//***********************************
	//		Variables
	//***********************************
	private String id_user, login_user,   nom_user,	 prenom_user,  mail_user,  status_user, id_cookie ;
	
	/**
	 * Contructeur par defaut: créé un utilisateur avec les memes parametres que dans la base de données
	 * @param id_user	String identifiant base de données de l'user
	 * @param login_user	String login de l'user
	 * @param nom_user
	 * @param prenom_user
	 * @param mail_user
	 * @param status_user	String Status = admin ou client
	 */
	public MyUser(String id_user, String login_user,  String nom_user,	String prenom_user, String mail_user, String  status_user,String id_cookie){
		this.id_user=id_user;
		this.login_user=login_user;
		this.nom_user=nom_user;
		this.prenom_user=prenom_user;
		this.mail_user=mail_user;
		this.status_user=status_user;
		this.id_cookie=id_cookie;
	}
	
	//************************************
	//	Getter et setter
	//************************************
	public String getId_user() {
		return id_user;
	}

	public String getLogin_user() {
		return login_user;
	}
	
	public String getNom_user() {
		return nom_user;
	}

	public String getPrenom_user() {
		return prenom_user;
	}

	public String getMail_user() {
		return mail_user;
	}

	public String getStatus_user() {
		return status_user;
	}

	public String getId_cookie() {
		return id_cookie;
	}

		
}
