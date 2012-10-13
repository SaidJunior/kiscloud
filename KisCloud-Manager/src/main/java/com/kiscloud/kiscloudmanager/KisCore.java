/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.kiscloud.kiscloudmanager;

import com.jcraft.jsch.*;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import org.apache.log4j.Level;
import org.apache.log4j.Logger;
import org.apache.log4j.Priority;

/**
 *
 * @author clement
 */
public class KisCore {

    private static final Logger logger = Logger.getLogger(KisCore.class);

    public KisCore() {
        logger.log(Level.INFO, "Object Init");
    }

    public void ssh_init(String host, String password) {
        InputStream in = null;

        try {
            logger.log(Level.INFO, "ssh_init() called");

            JSch ssh = new JSch();
            Session session = ssh.getSession("root", host, 22);
            session.setPassword(password);
            session.setUserInfo(myUserInfo());
            session.connect();
            Channel channel = session.openChannel("exec");
            ((ChannelExec) channel).setCommand("hostname");

            // X Forwarding
            // channel.setXForwarding(true);

            //channel.setInputStream(System.in);
            channel.setInputStream(null);

            //channel.setOutputStream(System.out);

            //FileOutputStream fos=new FileOutputStream("/tmp/stderr");
            //((ChannelExec)channel).setErrStream(fos);
            ((ChannelExec) channel).setErrStream(System.err);
            in = channel.getInputStream();

            channel.connect();

            byte[] tmp = new byte[1024];
            while (true) {
                while (in.available() > 0) {
                    int i = in.read(tmp, 0, 1024);
                    if (i < 0) {
                        break;
                    }
                    System.out.print(new String(tmp, 0, i));
                }
                if (channel.isClosed()) {
                    System.out.println("exit-status: " + channel.getExitStatus());
                    break;
                }
            }
            channel.disconnect();
            session.disconnect();

//            try {
//                Process proc = Runtime.getRuntime().exec("ssh -v root@"+host+" 'hostname'");
//
//                BufferedReader bri = new BufferedReader(new InputStreamReader(proc.getInputStream()));
//                BufferedReader bre = new BufferedReader(new InputStreamReader(proc.getErrorStream()));
//                String line="";
//                
//                while ((line = bri.readLine()) != null) {
//                    logger.log(Level.INFO, "SSH_Output: "+line);
//                }
//                bri.close();
//                while ((line = bre.readLine()) != null) {
//                    logger.log(Level.ERROR, "SSH_Error: "+line);
//                }
//                bre.close();
//                proc.waitFor();
//                int exitValue = proc.exitValue();
//                proc.destroy();
//                logger.log(Level.INFO, "SSH Done with exit value: "+exitValue);
//
//            } catch (InterruptedException ex) {
//                java.util.logging.Logger.getLogger(KisCore.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
//            } catch (IOException ex) {
//                java.util.logging.Logger.getLogger(KisCore.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
//            }

       
        } catch (IOException ex) {
            System.out.println("Error Input");
            java.util.logging.Logger.getLogger(KisCore.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (JSchException ex) {
            java.util.logging.Logger.getLogger(KisCore.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
            
        } finally {
            try {
                in.close();
            } catch (NullPointerException ex){
                // in == null -> So error due to ssh login
                logger.log(Level.FATAL, "SSH_Client: Error login");
            } catch (IOException ex) {
                java.util.logging.Logger.getLogger(KisCore.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
            }
        }

    }

    public void ssh_cmd(String host, String cmd) {
    }
    
    public UserInfo myUserInfo(){
        UserInfo ui = new UserInfo() {

            private final Logger logger = Logger.getLogger(UserInfo.class);
            
            public String getPassphrase() {
                throw new UnsupportedOperationException("Not supported yet.");
            }

            public String getPassword() {
                throw new UnsupportedOperationException("Not supported yet.");
            }

            public boolean promptPassword(String string) {
                return false;
            }

            public boolean promptPassphrase(String string) {
                return false;
            }

            public boolean promptYesNo(String string) {
                return true;
            }

            public void showMessage(String string) {
                logger.log(Level.INFO, "SSH_Client_Messages: "+string);
            }
        };
        return ui;
    }
}
