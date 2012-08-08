package rie6.serveur.model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;

import rie6.client.admin.model.User;
import rie6.serveur.controleur.ControleurServeur;

public class GetListUser {

	private ControleurServeur controleurServeur;
	private Connection connect = null;
	private Statement statement = null;
	private ResultSet resultSet;
	private List<User> listInfoBase;

	public GetListUser(ControleurServeur controleurServeur){
		
		//preparation du driver JAR
        try {
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			
	         // init de la connexion
	        connect = DriverManager.getConnection("jdbc:mysql://localhost:3306/kiscloud?user=root&password="+controleurServeur.getMdpBDD());
	        // Statements pour authoriser les requettes SQL
	        statement = connect.createStatement();
	        // ecriture et execution de la requete
	        resultSet = statement.executeQuery("select * from kiscloud.USERS");
	   
	        while(resultSet.next()){
	        	System.out.println(" Je remplis ma liste d'utilisateur (GetListUser) ");
	        	User user = new User(resultSet.getString("id_user"),resultSet.getString("login_user"),resultSet.getString("mdp_user"),resultSet.getString("nom_user"),resultSet.getString("prenom_user"),resultSet.getString("mail_user"),resultSet.getString("status_user"));
	        	listInfoBase.add(user);
	        }
	        
	        

		} catch (SQLException e) {
			
			e.printStackTrace();
		} catch (InstantiationException e) {
			
			e.printStackTrace();
		} catch (IllegalAccessException e) {
	
			e.printStackTrace();
		} catch (ClassNotFoundException e) {
		
			e.printStackTrace();
		}
	}

	public List<User> getListInfoBase() {
		return listInfoBase;
	}


}
