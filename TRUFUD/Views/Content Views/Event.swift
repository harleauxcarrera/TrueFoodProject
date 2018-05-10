//
//  Event.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 5/10/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import Foundation
public class Event{
    
    var title: String
    var location: String
    var date: String
    var description: String
    
    init(title: String, location: String, date: String, description: String) {
        self.title = title
        self.location = location
        self.date = date
        self.description = description
    }
    
    public func displayEvents(){
        print("\n")
        print("Event: \(title)")
        print("location: \(location)")
        print("date: \(date)")
        print("description: \(description)")
        print("\n")
    }
    
}
