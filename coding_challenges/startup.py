startup_sent = fields.Boolean('Project Startup message already sent?')

def project_startup(self):

        for rec in self.env['sale.order'].search([('state','=','sale')]):
            template_id = env['mail.template'].search([('name','=','Project Startup: What to Expect')])
            template_id.with_context().sudo().send_mail(rec.id, force_send=True)
        self.startup_sent = True
        

def project_startup(self):
        for rec in self.env['sale.order'].search([('state','=','sale')]):
            date_diff = date.today() - rec.date_order.date()

            if date_diff.days == 2:
                template_id = env['mail.template'].search([('name','=','Project Startup: What to Expect')])
                template_id.with_context().sudo().send_mail(rec.id, force_send=True)
            self.startup_sent = True
        