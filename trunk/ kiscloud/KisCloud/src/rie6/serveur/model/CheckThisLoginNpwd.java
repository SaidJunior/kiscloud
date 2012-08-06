package rie6.serveur.model;

import java.sql.Connection;

import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.UUID;

import rie6.serveur.controleur.ControleurServeur;

public class CheckThisLoginNpwd {
	//*****************************************
	// variable
	//*****************************************
	private ControleurServeur controleurServeur;
	private Connection connect = null;
	private Statement statement = null;
	private ResultSet resultSet = null;
	private PreparedStatement preparedStatement=null;
	private String[] retour = new String[7];			// variable de retour
	/**
	 * Recherche le login et mot de passe dans la base
	 * @param controleurServeur 
	 * @param login
	 * @param pwd
	 */
	public CheckThisLoginNpwd(ControleurServeur controleurServeur, String login, String pwd) {
		this.controleurServeur = controleurServeur;
		//******************************
		// 	Connexion à la base
		//******************************
		
		try {
			//chargement du driver
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			
			 // init de la connexion
		    connect = DriverManager.getConnection("jdbc:mysql://localhost:3306/KISCLOUD?user=root&password="+controleurServeur.getMdpBDD());
		    
			// Statements pour authoriser les requettes SQL
		    statement = connect.createStatement();
		    
		    // ecriture et execution de la requete
		    preparedStatement = connect.prepareStatement("SELECT * FROM KISCLOUD.USERS WHERE login_user=? AND mdp_user=?");
		    preparedStatement.setString(1,login);
		    preparedStatement.setString(2,pwd);
		    resultSet = preparedStatement.executeQuery();
		    
		    //on se positionne sur la derniere ligne de resultat. Il doit en avoir qu'une si le login et pass existe
		    resultSet.last();
		    if (resultSet.getRow()==0){
			   //alors l'id n'existe pas on retour null pour afficher le formulaire de login
		    	retour[0] =null;
		    }else{
		    	//on a trouvé une ligne. le login est mot de passe sont ok. On recup les info sur l'user pour les renvoyer
		    	retour[0]=resultSet.getString("id_user");
		    	retour[1]=resultSet.getString("login_user");
		    	retour[2]=resultSet.getString("nom_user");
		    	retour[3]=resultSet.getString("prenom_user");
		    	retour[4]=resultSet.getString("mail_user");
		    	retour[5]=resultSet.getString("status_user");
		    	
		    	// On genere un nouveau id de cookie
	    	    UUID idOne = UUID.randomUUID();
				// on le transforme en String pour le stocker dans la base
	    	    retour[6] = idOne.toString();
	    	    //on set cet ID dans la base
	    	    preparedStatement = connect.prepareStatement("update USERS set id_cookie = ? WHERE id_user = ?");
			    //on regle les paramettres (Attention le premier paramettre commence à 1
			    preparedStatement.setString(1,retour[6]);
			    preparedStatement.setString(2, retour[0]);
			    // execution
			    preparedStatement.executeUpdate();
		    }
		    	
		    
		    
		} catch (InstantiationException e) {
			e.printStackTrace();
		} catch (IllegalAccessException e) {
			
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
			
			e.printStackTrace();
		} catch (SQLException e) {
			
			e.printStackTrace();
		}
		
		
		
	}
	//******************************
	// 	Getter et setter
	//******************************
	public String[] getRetour() {
		return retour;
	}
	
}




















