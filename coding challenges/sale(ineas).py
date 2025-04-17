from odoo import api, fields, models,_
from odoo.exceptions import UserError
from datetime import date, timedelta

class SaleOrder(models.Model):
    _inherit = "sale.order"
    _description = "Sale Order"

    stage = fields.Selection([('completed', 'Project Completed'),('estimate_declined','Estimate Declined'),('estimate_approved','Estimate Approved'),('estimate_confirmed','Estimate Confirmed')])
    active = fields.Boolean('Active',default=True)
    state_list = [('draft', 'Estimate'), ('sent', 'Estimate Sent'), ('sale', 'Sales Order'), ('done', 'Locked'), ('cancel', 'Cancelled')]
    state = fields.Selection([
        ('draft', 'Estimate'),
        ('sent', 'Estimate Sent'),
        ('sale', 'Sales Order'),
        ('done', 'Locked'),
        ('cancel', 'Cancelled'),
        ], string='Status', readonly=True, copy=False, index=True, tracking=3, default='draft')
    expiry_reason = fields.Char('Expiry Reason')
    

    def action_confirm(self):
        res = super(SaleOrder, self).action_confirm()
        if self.state == 'sale':
            project_id = self.env['project.project'].search([('sale_order_id','=',self.id)],limit=1)
            if self.opportunity_id and project_id:
                self.opportunity_id.project_id = project_id.id
                project_id.crm_id = self.opportunity_id.id
        return res

    def cron_send_weekly_status(self):
        for rec in self.env['sale.order'].search([('state','=','draft')]):
            date_diff = date.today() - rec.create_date.date()
            if date_diff.days <= 7:
                template_id = self.env.ref('ppts_crm_sales.sales_weekly_email')
                template_id.with_context().sudo().send_mail(rec.id, force_send=True)
                
        return True

    def yearly_followup(self):
        for rec in self.env['sale.order'].search([('state','=','sale')]):
            date_diff = date.today() - rec.create_date.date()
            if date_diff.days <= 365:
                template_id = self.env.ref('ppts_crm_sales.followup_mail')
                template_id.with_context().sudo().send_mail(rec.id, force_send=True)
        return True

    def cancel_action(self):
        for rec in self.env['sale.order'].search([('state','!=','sale')]):
            date_expiry_order = rec.create_date + timedelta(days=34)   
            if rec.stage == 'estimate_declined':
                date_expired = date_expiry_order + timedelta(days=15)
                if date_expired.days == 14:
                    rec.write({'state':'cancel','active':False})
                
        return True
        
    #def _change_state(self, cr, uid, context=None):
      #  return [('draft', 'Estimate'), ('sent', 'Estimate Sent'), ('sale', 'Sales Order'), ('done', 'Locked'), ('cancel', 'Cancelled'),
       #         ], string='Status', readonly=True, copy=False, index=True, tracking=3, default='draft'
    
    @api.depends('state')
    def _compute_type_name(self):
        for record in self:
            record.type_name = _('Estimate') if record.state in ('draft', 'sent', 'cancel') else _('Sales Order')
                
                
    def send_what_next(self):
        for rec in self.env['sale.order'].search([('state','=','sale')]):            
              if rec.date_order:
                  d2 = datetime.date.today()
                  d1 = rec.date_order
                  diff = (d1-d2).days

                  if diff==1: 
                      template = env['mail.template'].search([('name', '=', 'What to Expect')])
                      if template:
                          template.send_mail(rec.id)
                
                
    
    
    

        
    
    
