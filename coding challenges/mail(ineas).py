def _action_confirm(self):
        """ On SO confirmation, some lines should generate a task or a project. """
        result = super()._action_confirm()
        for order in self.order_line:
            user, email = False, False
            if order.project_id:
                self.project_sheet_attach = self.create_project_sheet_report().id
                if order.project_id.user_id:
                    user = order.project_id.user_id.name or False
                    email = order.project_id.user_id.email or False
                elif self.team_id:
                    user = self.team_id.user_id.name or False
                    email = self.team_id.user_id.email or False
                if user and email:  
                    mail_body = """Dear """ + str(user) + """</br><p>&nbsp;</p>
                                    Project Sheet Report was generated Please find the Attachment
                                """
                    mail_values = {
                        'email_to': email,
                        'subject': 'Project Sheet Report',
                        'body_html': mail_body,
                    }
                    mail_obj = self.env['mail.mail'].sudo().create(mail_values)
                    mail_obj.write({'attachment_ids': [(4, self.create_project_sheet_report().id)]})
                    mail_obj.send()
        return result

def _action_confirm(self):
    """ On SO confirmation, some lines should generate a task or a project. """
    result = super()._action_confirm()
    #attachment = self.create_project_sheet_report()
    
    # Collect unique users and their corresponding emails
    users_emails = {}
    for order in self.order_line:
        user, email = False, False
        if order.project_id:
            self.project_sheet_attach = self.create_project_sheet_report().id
            if order.project_id.user_id:
                user = order.project_id.user_id.name or False
                email = order.project_id.user_id.partner_id.email or False
            elif self.team_id:
                user = self.team_id.user_id.name or False
                email = self.team_id.user_id.partner_id.email or False
            if user and email:  
                if user not in users_emails:
                    users_emails[user] = []
                    users_emails[user].append(email)
    
    # Send emails to each unique user
    for user, emails in users_emails.items():
        mail_body = """Dear """ + str(user) + """</br><p>&nbsp;</p>
                                    Project Sheet Report was generated Please find the Attachment
                                """
        mail_values = {
            'email_to': users_emails[emails],
            'subject': 'Project Sheet Report',
            'body_html': mail_body,
        }
        mail_obj = self.env['mail.mail'].sudo().create(mail_values)
        mail_obj.write({'attachment_ids': [(4, self.create_project_sheet_report().id)]})
        mail_obj.send()
    
    return result


def _action_confirm(self):
    """ On SO confirmation, some lines should generate a task or a project. """
    result = super()._action_confirm()
    attachment = self.create_project_sheet_report()
    
    # Collect project information and email recipients for projects in the Surveying sales team
    projects_info = {}
    for order in self.order_line:
        if order.project_id and order.team_id.name == 'Surveying':
            project = order.project_id
            if project.user_id:
                user = project.user_id.name
                email = project.user_id.partner_id.email
            elif self.team_id and self.team_id.user_id:
                user = self.team_id.user_id.name
                email = self.team_id.user_id.partner_id.email
            else:
                continue  # Skip if no user or team user with email found
            if email not in projects_info:
                projects_info[email] = {
                    'user': user,
                    'attachments': [attachment.id],
                    'project_info': []
                }
            projects_info[email]['project_info'].append(project)
    
    # Send a single email with all relevant project information
    for email, data in projects_info.items():
        user = data['user']
        attachments = data['attachments']
        projects = data['project_info']
        mail_body = """Dear {}</br><p>&nbsp;</p>
                        Project Sheet Report was generated Please find the Attachments
                    """.format(user)
        mail_values = {
            'email_to': email,
            'subject': 'Project Sheet Report',
            'body_html': mail_body,
        }
        mail_obj = self.env['mail.mail'].sudo().create(mail_values)
        mail_obj.write({'attachment_ids': [(4, att_id) for att_id in attachments]})
        mail_obj.send()

    return result


def _action_confirm(self):
        """ On SO confirmation, some lines should generate a task or a project. """
        result = super()._action_confirm()
        attachment = self.create_project_sheet_report()

        # Collect unique users and their corresponding emails
        users_emails = {}
        for order in self.order_line:
            if order.project_id:
                user, email = False, False
                if order.project_id.user_id:
                    user = order.project_id.user_id.name or False
                    email = order.project_id.user_id.email or False
                elif self.team_id:
                    user = self.team_id.user_id.name or False
                    email = self.team_id.user_id.email or False
                if user and email:  
                    if user not in users_emails:
                        users_emails[user] = []
                        email = users_emails[user].append(email)    

        # Send emails to each unique user
        for user, emails in users_emails.items():
            mail_body = """Dear """ + str(user) + """</br><p>&nbsp;</p>
                                    Project Sheet Report was generated Please find the Attachment
                                """
            mail_values = {
                'email_to': emails,
                'subject': 'Project Sheet Report',
                'body_html': mail_body,
            }
            mail_obj = self.env['mail.mail'].sudo().create(mail_values)
            mail_obj.write({'attachment_ids': [(4, attachment.id)]})
            mail_obj.send()

        return result