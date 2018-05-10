//
//  Recipes.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 5/10/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import Foundation
public class Recipe{
    
    var title: String
    var link: String
    var ingredients: String
    
    init(title: String, link: String, ingredients:String){
        self.title = title
        self.link = link
        self.ingredients = ingredients
    }
    
    public func displayRecipes(){
        print("\n")
        print("Recipe: \(title)")
        print("link: \(link)")
        print("ingredients: \(ingredients)")
        print("\n")
    }
    
}
