package com.kiscloud.kiscloudmanager;

import org.apache.log4j.Level;
import org.apache.log4j.Logger;

/**
 * Hello world!
 *
 */
public class Main 
{

    private static final Logger logger = Logger.getLogger(Main.class);

    public Main(){
        logger.log(Level.INFO, "Main Start");
    }
    
    public static void main( String[] args )
    {
        Main main = new Main();
        KisCore kisCore = new KisCore();
        kisCore.ssh_init("147.171.79.215", "k!scl0ud-20122");
    }
}
