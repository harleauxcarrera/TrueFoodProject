//
//  EventsVC.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 5/10/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit
import SwiftyJSON

class EventsVC: UIViewController {

    var events = [Event]()
    
    override func viewDidLoad() {
        super.viewDidLoad()
        fetchEvents()
        // Do any additional setup after loading the view.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func fetchEvents(){
        //get request
        let url = URL(string: "http://192.168.0.14/True_Food_App/ViewControllers/Events.php")
        let session = URLSession.shared
        if let usableUrl = url {
            
            let task = session.dataTask(with: usableUrl, completionHandler: { (data, response, error) in
                
                if data == nil {
                    print("failed to retrieve ")
                }
                
                do{
                    
                    let jsonData = try JSONSerialization.jsonObject(with: data!, options: JSONSerialization.ReadingOptions.mutableContainers) as AnyObject
                    
                    //entire array of data fetched in JSON
                    
                    let json = JSON(jsonData)
                    
                    //now make objects of course with this data
                    
                    for event in json.arrayValue {
                        
                        let eventTitle = event["title"].stringValue
                        let eventLocation = event["location"].stringValue
                        let eventDate = event["date"].stringValue
                        let eventDescription = event["description"].stringValue
                        
                        //create the course to add to array
                        let fetchedEvent = Event(title: eventTitle, location: eventLocation, date: eventDate, description: eventDescription)
                        self.events.append(fetchedEvent)
                    }
                    
                    self.displayEvents()
                    
                }catch{
                    print("Task not initiated")
                }
                
            })//end of session setup
            
            task.resume()
        }
    }//end function fetch classes
    
    func displayEvents(){
        for event in events{
            event.displayEvents()
        }
    }
}
