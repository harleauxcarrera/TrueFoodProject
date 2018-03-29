//
//  VacantAccountLoginVC.swift
//  TRUFUD
//
//  Created by Erick Javier Duarte on 2/24/18.
//  Copyright © 2018 Harleaux Carrera. All rights reserved.
//

import UIKit

class AccountCheckerVC: UIViewController {

    var error_messg: String!
    @IBOutlet weak var message_label: UILabel!
    @IBAction func dismiss(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    override func viewDidLoad() {
        super.viewDidLoad()
        message_label.text = error_messg
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }


}
