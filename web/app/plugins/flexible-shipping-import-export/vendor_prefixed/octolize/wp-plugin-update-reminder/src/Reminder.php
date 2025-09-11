<?php

namespace FlexibleShippingImportExportVendor\Octolize\PluginUpdateReminder;

interface Reminder
{
    public function create_reminder(ReminderData $reminder_data): void;
}
