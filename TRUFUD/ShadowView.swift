//
//  ShadowView.swift
//  TRUFUD
//
//  Created by Carlos Herrera on 1/17/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit

class ShadowView: UIView {

    override func awakeFromNib(){
        self.layer.shadowOpacity = 2
        self.layer.shadowRadius = 10
        self.layer.shadowColor = UIColor.black.cgColor
        super.awakeFromNib()
    }

}
