from odoo import api, fields, models,_
from odoo.exceptions import UserError
from datetime import date

class ProjectProject(models.Model):
    _inherit = "project.project"
    _description = "Project"

    digital_file_location = fields.Char(string='URL for digital file')
    scheduling_planning = fields.Date(string='Scheduling and Planning')
    review_prepare_invoice = fields.Date(string='Review and prepare invoice')
    review_prepare_deliverables = fields.Date(string='Review and prepare deliverables')
    crm_id = fields.Many2one('crm.lead','CRM')
    completed_projects = fields.Boolean('Completed Project')
    startup_sent = fields.Boolean('Project Startup message already sent')

    def completed_project(self):
        so_id = []
#        for record in self.env['project.task'].search([('project_id', '=', self.id)]):
#            if record.sale_order_id and record.sale_order_id.id not in so_id:
#                so_id.append(record.sale_order_id.id)
#                record.sale_order_id.stage = 'completed'
#                template_id = self.env.ref('ppts_crm_sales.project_completed_sales_mail')
#                template_id.with_context().sudo().send_mail(record.sale_order_id.id, force_send=True)
        self.completed_projects = True
#        template_id = self.env.ref('ppts_crm_sales.project_completed_email')
#        template_id.with_context().sudo().send_mail(self.id, force_send=True)
        project_ids=self.env['project.profitability.report'].search([('project_id','=',self.id)])
        timesheet_cost = 0
        so_amount = 0
        sale_id = []
        for pro in project_ids:
            if pro.sale_order_id.id not in sale_id:
                sale_id.append(pro.sale_order_id.id)
                so_amount += pro.sale_order_id.amount_untaxed
            timesheet_cost += pro.timesheet_cost
        budget = abs(timesheet_cost/so_amount)
        template_id = self.env.ref('ppts_crm_sales.project_summary_mail')
        template_id.with_context({'timesheet_cost': timesheet_cost,'so_amount': so_amount,'budget':budget}).sudo().send_mail(self.id, force_send=True)

    def project_startup(self):

        for rec in self.env['sale.order'].search([('state','=','sale')]):
            template_id = env['mail.template'].search([('name','=','Project Startup: What to Expect')])
            template_id.with_context().sudo().send_mail(rec.id, force_send=True)
        self.startup_sent = True

         